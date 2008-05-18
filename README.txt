XML_GRDDL

SVN (primary home):
http://code.google.com/p/xmlgrddl/source/browse/trunk/

PEAR CVS:
Only stable releases should end up sync'd with pear CVS.

Patches:
 - Grab a copy of the svn trunk to try out your patch
 - You want to run the grddl tests to ensure there's no regression
        To run:
                1) Grab the zip archive from http://www.w3.org/TR/grddl-tests/#deliverables
                2) Extract to somewhere, like ~/grddl-tests/ or c:\grddl-tests\
                2) Make sure you've got Python
                3) Run (in your grddl-tests dir!)
                        `python testft.py -r '/usr/bin/php ~/xml_grddl/scripts/process-grddl.php' --debug grddl-tests.rdf`
                    or
                        `python testft.py -r 'c:/php/php.exe c:/xml_grddl/scripts/process-grddl.php' --debug grddl-tests.rdf`