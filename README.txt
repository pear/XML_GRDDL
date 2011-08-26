XML_GRDDL

Patches:
You want to run the grddl tests to ensure there's no regression

To run:
1) Grab the zip archive from http://www.w3.org/TR/grddl-tests/#deliverables
$ wget http://www.w3.org/TR/grddl-tests/grddl-tests.zip

2) Extract to somewhere, like ~/grddl-tests/
3) Make sure you've got Python
$ apt-get install python

4) Run (in your grddl-tests dir!)
$ cd ~/grddl-tests/
$ python testft.py --run "/usr/bin/php ~/xml_grddl/scripts/process-grddl.php" --debug grddl-tests.rdf

