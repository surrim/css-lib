<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Surrim\CssLib\Css;

class CssLibTest extends TestCase {
    public function testSerialize(): void {
      $css = new Css();
      $css->addRules(null, ['*'], ['padding' => 0]);

      $this->assertSame($css->serialize(), '*{padding:0}');
      $this->assertSame($css->prettySerialize(), "* { padding: 0; }\n");
    }
}
