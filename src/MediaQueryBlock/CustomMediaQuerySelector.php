<?php

namespace Surrim\CssLib\MediaQueryBlock;

readonly class CustomMediaQuerySelector extends MediaQuerySelector {
  public function __construct(
      private string  $property,
      private ?string $value
  ) {
  }

  public function serialize(): string {
    return '@media(' . $this->property . ($this->hasValue() ? ':' . $this->value : '') . ')';
  }

  public function hasValue(): bool {
    return $this->value !== null;
  }

  public function prettySerialize(): string {
    return '@media (' . $this->property . ($this->hasValue() ? ': ' . $this->value : '') . ')';
  }

  public function hasEffect(): bool {
    return false;
  }

  public function getCompareClosures(): array {
    return [
        fn(CustomMediaQuerySelector $x) => $x->getProperty(),
        fn(CustomMediaQuerySelector $x) => $x->getValue()
    ];
  }

  public function getProperty(): string {
    return $this->property;
  }

  public function getValue(): ?string {
    return $this->value;
  }
}
