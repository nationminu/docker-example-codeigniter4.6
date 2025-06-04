<?php

namespace Config;

use CodeIgniter\Config\BaseService;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Libraries\TwigCustomExtension;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */


	/**
	 * 템플릿 렌더링 서비스
	 *
	 * @param bool $getShared 공유 인스턴스 사용 여부
	 * @return Environment
	 */
	public static function twig(bool $getShared = true): Environment
	{
		if ($getShared) {
			return static::getSharedInstance('twig');
		}

		$config = config('Twig');

		$loader = new FilesystemLoader($config->viewsPath);

		$twig = new Environment($loader, [
			'cache' => $config->cachePath,
			'auto_reload' => $config->autoReload,
			'debug' => $config->debug,
		]);

		// 커스텀 Twig 함수 추가
		$twig->addExtension(new TwigCustomExtension());

		return $twig;
	}

	/**
	 * 템플릿 렌더링 서비스
	 *
	 * @param string $template 템플릿 파일 경로
	 * @param array $data 템플릿에 전달할 데이터
	 * @return string 렌더링된 템플릿 코드
	 */
	public static function render(string $template, array $data = []): string
	{
		$config = config('Twig');
		$templateWithExtension = $template . $config->templateExtension;

		// layout 키가 없으면 기본값 'base'로 설정
		if (!array_key_exists('layout', $data)) {
			$data['layout'] = $config->templateLayout ?? 'base';
		}
		return static::twig()->render($templateWithExtension, $data);
	}
}
