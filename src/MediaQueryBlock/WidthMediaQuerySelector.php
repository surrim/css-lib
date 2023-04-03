<?php

namespace Surrim\CssLib\MediaQueryBlock;

readonly class WidthMediaQuerySelector extends MediaQuerySelector {
  private int $minWidth;
  private ?int $maxWidth;
  private string $unit;

  public function __construct(?int $minWidth, ?int $maxWidth = null, string $unit = 'px') {
    $this->minWidth = $minWidth ?? 0;
    $this->maxWidth = $maxWidth;
    $this->unit = $unit;
  }

  public function serialize(): string {
    $parts = [];
    if ($this->minWidth > 0) {
      $parts[] = '@media(min-width:' . $this->minWidth . $this->unit . ')';
    }
    if ($this->maxWidth !== null) {
      $parts[] = '@media(max-width:' . $this->maxWidth . $this->unit . ')';
    }
    return join(' and ', $parts);
  }

  public function prettySerialize(): string {
    $parts = [];
    if ($this->minWidth > 0) {
      $parts[] = "@media (min-width: $this->minWidth$this->unit)";
    }
    if ($this->maxWidth !== null) {
      $parts[] = "@media (max-width: $this->maxWidth$this->unit)";
    }
    return join(' and ', $parts);
  }

  public function hasEffect(): bool {
    return $this->minWidth <= 0 && $this->maxWidth === null;
  }

  public function getCompareClosures(): array {
    return [
        fn(WidthMediaQuerySelector $x) => $x->getUnit(),
        fn(WidthMediaQuerySelector $x) => $x->getMinWidth(),
        fn(WidthMediaQuerySelector $x) => $x->getMaxWidth()
    ];
  }

  public function getUnit(): string {
    return $this->unit;
  }

  public function getMinWidth(): int {
    return $this->minWidth;
  }

  public function getMaxWidth(): ?int {
    return $this->maxWidth;
  }
}
