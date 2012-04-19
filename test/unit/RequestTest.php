<?php

class RequestTest extends PHPUnit_Framework_TestCase {

    public function testExtractsId() {
        $this->assertEquals(
            '12345zx',
            self::request('/12345zx.jpg')->id
        );
    }

    public function testExtractsGroup() {
        $this->assertEquals(
            'adm',
            self::request('/adm/12345zx.jpg')->group
        );
    }

    public function testUnderstandsOutputContentTypeByExtension() {
        $this->assertEquals(
            ContentType::jpeg(),
            self::request('/12345zx.jpg')->contentType
        );
    }

    public function testExtractsCommandStringFromUri() {
        $r = self::request('/123erwe34_175x75_bgFFF_bw.jpg');
        $this->assertEquals('175x75_bgFFF_bw', $r->commandString);
    }

    public function testExtractsAll() {
        $r = self::request('/adm/123erwe34_175x75_bgFFF_bw.jpg');
        $this->assertEquals('adm', $r->group);
        $this->assertEquals('123erwe34', $r->id);
        $this->assertEquals('175x75_bgFFF_bw', $r->commandString);
        $this->assertEquals(ContentType::jpeg(), $r->contentType);
    }

//--------------------------------------------------------------------------------------------------

    private static function request($uri) {
        return new Request($uri, null);
    }
}