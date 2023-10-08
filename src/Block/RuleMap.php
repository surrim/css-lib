<?php

namespace Surrim\CssLib\Block;

class RuleMap {
  private array $rules;

  public function __construct(array $rules) {
    foreach ($rules as $property => $value) {
      $this->addRule($property, $value);
    }
  }

  public function addRule(string $property, string $value): void {
    $trimmedProperty = trim($property);
    $trimmedValue = implode(
        PHP_EOL,
        array_filter(
            array_map(
                fn($valueLine) => trim($valueLine),
                explode(PHP_EOL, $value)
            ),
            fn($valueLine) => $valueLine !== ''
        )
    );
    $this->rules[$trimmedProperty] = $trimmedValue;
  }

  public function equals(RuleMap $ruleMap): bool {
    return $ruleMap->getRules() === $this->rules;
  }

  /**
   * @return array
   */
  public function getRules(): array {
    return $this->rules;
  }

  public function isEmpty(): bool {
    return $this->rules === [];
  }

  public function serialize(): string {
    $css = '{';
    foreach ($this->rules as $property => $value) {
      if ($property !== array_key_first($this->rules)) {
        $css .= ';';
      }
      $css .= $property . ':' . strtr($value, [PHP_EOL => ' ']);
    }
    $css .= '}';
    return $css;
  }

  public function prettySerialize(string $tabs): string {
    $css = "{";
    if (count($this->rules) > 2) {
      $css .= "\n";
      foreach ($this->rules as $property => $value) {
        $pValue = self::prettyRuleValue($value, "$tabs  ");
        $css .= "$tabs  $property:$pValue;\n";
      }
      $css .= "$tabs";
    } else {
      foreach ($this->rules as $property => $value) {
        $pValue = self::prettyRuleValue($value, $tabs);
        $css .= " $property:$pValue;";
      }
      $css .= " ";
    }
    $css .= "}";
    return $css;
  }

  private static function prettyRuleValue(string $value, string $tabs): string {
    if (str_contains($value, "\n")) {
      return "\n$tabs  " . strtr($value, ["\n" => "\n$tabs  "]);
    }
    return " $value";
  }

  public function merge(RuleMap $ruleMap): void {
    foreach ($ruleMap->getRules() as $property => $value) {
      $this->addRule($property, $value);
    }
  }
}