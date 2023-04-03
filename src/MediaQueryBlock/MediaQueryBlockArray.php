<?php

namespace Surrim\CssLib\MediaQueryBlock;

class MediaQueryBlockArray {
  private array $mediaQueryBlocks = [];

  public function addRules(MediaQuerySelector $mediaQuerySelector, array $selectors, array $rules, bool $extendSameSelectorsBlock = true): void {
    /** @var MediaQueryBlock $mediaQueryBlock */
    foreach ($this->mediaQueryBlocks as $mediaQueryBlock) {
      if ($mediaQuerySelector->equals($mediaQueryBlock->getMediaQuerySelector())) {
        $mediaQueryBlock->getBlockArray()->addRules($selectors, $rules, $extendSameSelectorsBlock);
        return;
      }
    }
    $newMediaQueryBlock = new MediaQueryBlock($mediaQuerySelector);
    $newMediaQueryBlock->getBlockArray()->addRules($selectors, $rules, $extendSameSelectorsBlock);
    $this->mediaQueryBlocks[] = $newMediaQueryBlock;

    $sortClosure = fn(MediaQueryBlock $x, MediaQueryBlock $y) => $x->getMediaQuerySelector()->compareTo($y->getMediaQuerySelector());
    usort($this->mediaQueryBlocks, $sortClosure);
  }

  public function serialize(): string {
    $css = '';
    /** @var MediaQueryBlock $mediaQueryBlock */
    foreach ($this->mediaQueryBlocks as $mediaQueryBlock) {
      $css .= $mediaQueryBlock->serialize();
    }
    return $css;
  }

  public function prettySerialize(): string {
    $css = '';
    /** @var MediaQueryBlock $mediaQueryBlock */
    foreach ($this->mediaQueryBlocks as $mediaQueryBlock) {
      $css .= $mediaQueryBlock->prettySerialize();
    }
    return $css;
  }
}
