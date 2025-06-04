<?php
namespace App\Libraries;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigCustomExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        helper(['url', 'form', 'text', 'html', 'string']);

        return [
            new TwigFunction('number_format', 'number_format'),
            new TwigFunction('array_column', 'array_column'),
            new TwigFunction('strtolower', 'strtolower'),
            new TwigFunction('strtoupper', 'strtoupper'),

            new TwigFunction('getenv', 'getenv'),
            new TwigFunction('site_url', 'site_url'),
            new TwigFunction('strSlug', [$this, 'strSlug']),

            // CodeIgniter 헬퍼 함수들을 등록
            new TwigFunction('form_open', 'form_open', ['is_safe' => ['html']]),
            new TwigFunction('form_close', 'form_close', ['is_safe' => ['html']]),
            new TwigFunction('form_input', 'form_input', ['is_safe' => ['html']]),
            new TwigFunction('form_submit', 'form_submit', ['is_safe' => ['html']]),
            new TwigFunction('csrf_field', 'csrf_field', ['is_safe' => ['html']]),
            new TwigFunction('anchor', 'anchor', ['is_safe' => ['html']]),

            new TwigFunction('word_limiter', 'word_limiter'),
            new TwigFunction('character_limiter', 'character_limiter'),
            new TwigFunction('ellipsize', 'ellipsize'),
            new TwigFunction('nl2br', 'nl2br'),
            new TwigFunction('strip_tags', 'strip_tags'),
            new TwigFunction('lang', 'lang'),
            new TwigFunction('set_value', 'set_value'),
            new TwigFunction('session', 'session'),

            // 테스트 함수
            new \Twig\TwigFunction('test_function', function () {
                return 'Twig 확장 정상 등록됨';
            }),
        ];
    }

    /**
     * 문자열을 슬러그로 변환
     * @param string $string
     * @return string
     */
    public function strSlug($string)
    {
        return strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($string)));
    }
}
