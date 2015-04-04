<?php

namespace Flashbang;

/**
 * Indicates that parameters passed into a provider
 * were incomplete, incorrect, or otherwise encountered 
 * an error during operation. Always provide a meaningful
 * error message, as it will often be shown to the user when
 * possible.
 * 
 * @author liam
 */
class BadParameterException extends \Exception {
}
