<?php

namespace Surrim\CssLib\Block;

class BlockArray {
  private array $blocks = [];

  public function addRules(array $selectors, array $rules, bool $extendSameSelectorsBlock = true): void {
    /** @var Block $block */
    if ($extendSameSelectorsBlock) {
      $newSelectorSet = new SelectorSet($selectors);
      /** @var Block $block */
      foreach ($this->blocks as $block) {
        if ($block->getSelectorSet()->equals($newSelectorSet)) {
          $block->addRules($rules);
          return;
        }
      }
    } else {
      $newRuleMap = new RuleMap($rules);
      /** @var Block $block */
      foreach ($this->blocks as $block) {
        if ($block->getRuleMap()->equals($newRuleMap)) {
          $block->addSelectors($selectors);
          return;
        }
      }
    }
    $this->blocks[] = new Block($selectors, $rules);
  }

  public function prettySerialize($tabs = ''): string {
    $css = '';
    /** @var Block $block */
    foreach ($this->blocks as $block) {
      $css .= $block->prettySerialize($tabs);
    }
    return $css;
  }

  public function serialize(): string {
    $css = '';
    /** @var Block $block */
    foreach ($this->blocks as $block) {
      $css .= $block->serialize();
    }
    return $css;
  }
}
