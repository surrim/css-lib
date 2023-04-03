<?php

namespace Surrim\CssLib\Block;

class SelectorSet {
  private array $selectors;

  public function __construct(array $selectors) {
    $selectors = array_unique($selectors);
    sort($selectors);
    $this->selectors = $selectors;
  }

  public function equals(SelectorSet $selectorSet): bool {
    return $this->selectors === array_values($selectorSet->getSelectors());
  }

  public function getSelectors(): array {
    return $this->selectors;
  }

  public function isEmpty(): bool {
    return $this->selectors === [];
  }

  public function prettySerialize(): string {
    return implode(', ', $this->selectors);
  }

  public function serialize(): string {
    return implode(',', $this->selectors);
  }

  public function merge(SelectorSet $selectorSet): void {
    $this->selectors = array_unique(array_merge($this->selectors, $selectorSet->getSelectors()));
    sort($this->selectors);
  }
}