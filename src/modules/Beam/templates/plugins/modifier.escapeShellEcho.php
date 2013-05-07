<?php
/**
 * @brief Convert a string into a echo string
 * @param string $text
 * @return string
 */
function smarty_modifier_escapeShellEcho($text)
{
	return str_replace('"', '\"', str_replace("\\", "\\\\", $text));
}
