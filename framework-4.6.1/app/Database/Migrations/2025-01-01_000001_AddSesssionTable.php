<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSessionTable extends Migration
{
	/**
	 * 'handle_sessions' 테이블 생성
	 *
	 * 이 메소드는 'handle_sessions' 테이블을 생성하고, 각 컬럼에 대한
	 * 타입과 제약 조건을 설정합니다.
	 */
	public function up()
	{
		// 테이블에 추가할 필드 정의
		$this->forge->addField([
			// 고유 식별자, CHAR 타입, 36자리 제약, NULL 불가
			'id' => [
				'type'       => 'CHAR',
				'constraint' => 128,
				'null'       => false,
			],
			'ip_address' => [
				'type'       => 'CHAR',
				'constraint' => 45,
				'null'       => false,
			],
			// 플랫폼 이름, VARCHAR 타입, 최대 100자
			'data' => [
				'type' => 'blob',
				'null' => false,
			],
			// 삭제 일자, DATETIME 타입, NULL 가능
			'timestamp' => [
				'type'    => 'TIMESTAMP',
				'null'    => true,
				'default' => null, // null을 기본값으로 설정
				'useCurrent' => true, // 현재 시간 사용
			],
		]);

		// 'id' 컬럼을 기본 키로 설정
		$this->forge->addPrimaryKey('id');
		// 'timestamp' 컬럼을 키로 설정
		$this->forge->addKey('timestamp');
		// 'handle_sessions' 테이블 생성
		$this->forge->createTable('ci_session');
	}

	/**
	 * 'handle_sessions' 테이블 삭제
	 *
	 * 이 메소드는 마이그레이션을 되돌릴 때 호출되어 'handle_sessions' 테이블을 삭제합니다.
	 */
	public function down()
	{
		// 'handle_sessions' 테이블 삭제
		$this->forge->dropTable('ci_session');
	}
}
