<?php
require_once 'XML/GRDDL.php';
require_once 'Log.php';

$logger = Log::singleton('console');

$file = $_SERVER['argv'][1];

$options = XML_GRDDL::getDefaultOptions();
$options['log'] = $logger;
$options['quiet'] = false;


$grddl = XML_GRDDL::factory('xsl', $options);

print $grddl->crawl($file);


//python testft.py -r "php process-grddl.php " --debug grddl-tests.rdf > results.rdf
