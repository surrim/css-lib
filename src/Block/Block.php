<?php

namespace Surrim\CssLib\Block;

class Block {
  private SelectorSet $selectorSet;
  private RuleMap $ruleMap;

  public function __construct(array $selectors, array $rules) {
    $this->selectorSet = new SelectorSet($selectors);
    $this->ruleMap = new RuleMap($rules);
  }

  public function getSelectorSet(): SelectorSet {
    return $this->selectorSet;
  }

  public function getRuleMap(): RuleMap {
    return $this->ruleMap;
  }

  public function addRules(array $rules): void {
    $this->ruleMap->merge(new RuleMap($rules));
  }

  public function addSelectors(array $selectors): void {
    $this->selectorSet->merge(new SelectorSet($selectors));
  }

  public function serialize(): string {
    if ($this->isEmpty()) {
      return '';
    }
    return $this->selectorSet->serialize() . $this->ruleMap->serialize();
  }

  public function isEmpty(): bool {
    return $this->selectorSet->isEmpty() || $this->ruleMap->isEmpty();
  }

  public function prettySerialize(string $tabs): string {
    if ($this->isEmpty()) {
      return '';
    }
    return $tabs . $this->selectorSet->prettySerialize() . ' ' . $this->ruleMap->prettySerialize($tabs) . PHP_EOL;
  }
}
