<?php

namespace Surrim\CssLib;

use Surrim\CssLib\Block\BlockArray;
use Surrim\CssLib\MediaQueryBlock\MediaQueryBlockArray;
use Surrim\CssLib\MediaQueryBlock\MediaQuerySelector;

class Css {
  private BlockArray $blockArray;
  private MediaQueryBlockArray $mediaQueryBlockArray;

  public function __construct() {
    $this->blockArray = new BlockArray();
    $this->mediaQueryBlockArray = new MediaQueryBlockArray();
  }

  public function addRules(?MediaQuerySelector $mediaQuerySelector, array $selectors, array $rules, bool $extendSameSelectorsBlock = true): void {
    if ($mediaQuerySelector !== null && !$mediaQuerySelector->hasEffect()) {
      $this->mediaQueryBlockArray->addRules($mediaQuerySelector, $selectors, $rules, $extendSameSelectorsBlock);
    } else {
      $this->blockArray->addRules($selectors, $rules, $extendSameSelectorsBlock);
    }
  }

  public function serialize(): string {
    return $this->blockArray->serialize() . $this->mediaQueryBlockArray->serialize();
  }

  public function prettySerialize(): string {
    return $this->blockArray->prettySerialize() . $this->mediaQueryBlockArray->prettySerialize();
  }
}
