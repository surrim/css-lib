<?php

namespace Surrim\CssLib\MediaQueryBlock;

abstract readonly class MediaQuerySelector {
  public function equals(?MediaQuerySelector $mediaQuerySelector): bool {
    return $this->compareTo($mediaQuerySelector) === 0;
  }

  public function compareTo(?MediaQuerySelector $mediaQuerySelector): int {
    if ($mediaQuerySelector === null) {
      return 1;
    }
    foreach (array_merge([fn(mixed $x) => get_class($x)], $this->getCompareClosures()) as $compareClosure) {
      $cmp = $compareClosure($this) <=> $compareClosure($mediaQuerySelector);
      if ($cmp !== 0) {
        return $cmp;
      }
    }
    return 0;
  }

  public abstract function getCompareClosures(): array;

  public abstract function serialize(): string;

  public abstract function prettySerialize(): string;

  public abstract function hasEffect(): bool;
}
