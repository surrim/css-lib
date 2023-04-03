<?php

namespace Surrim\CssLib\MediaQueryBlock;

use Surrim\CssLib\Block\BlockArray;

class MediaQueryBlock {
  private MediaQuerySelector $mediaQuerySelector;
  private BlockArray $blockArray;

  public function __construct(MediaQuerySelector $mediaQuerySelector) {
    $this->mediaQuerySelector = $mediaQuerySelector;
    $this->blockArray = new BlockArray();
  }

  /**
   * @return MediaQuerySelector
   */
  public function getMediaQuerySelector(): MediaQuerySelector {
    return $this->mediaQuerySelector;
  }

  /**
   * @return BlockArray
   */
  public function getBlockArray(): BlockArray {
    return $this->blockArray;
  }

  public function prettySerialize(): string {
    return PHP_EOL . $this->mediaQuerySelector->prettySerialize() . ' {' . PHP_EOL . $this->blockArray->prettySerialize('  ') . '}' . PHP_EOL;
  }

  public function serialize(): string {
    return $this->mediaQuerySelector->serialize() . '{' . $this->blockArray->serialize() . '}';
  }
}
