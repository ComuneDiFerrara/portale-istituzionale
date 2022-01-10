<?php
/* SVN FILE: $Id: SassExtendNode.php 49 2010-04-04 10:51:24Z chris.l.yates $ */
/**
 * SassExtendNode class file.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */

/**
 * SassExtendNode class.
 * Represents a Sass @debug or @warn directive.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassExtendNode extends SassNode
{
  const IDENTIFIER = '@';
  const MATCH = '/^@extend\s+(.+)/i';
  const VALUE = 1;

  /**
   * @var string the directive
   */
  private $value;

  /**
   * SassExtendNode.
   * @param object $token source token
   * @return SassExtendNode
   */
  public function __construct($token)
  {
    parent::__construct($token);
    preg_match(self::MATCH, $token->source, $matches);
    $this->value = $matches[self::VALUE];
  }

  /**
   * Parse this node.
   * @return array An empty array
   */
  public function parse($context)
  {
    # resolve selectors in relation to variables
    # allows extend inside nested loops.
    $this->root->extend($this->value, $this->parent->resolveSelectors($context));

    return array();
  }
}
