#!/bin/bash
# Indexer update script - can be run every 10 minutes or so by crond
# add the following line to the crontab of the user who can change crontabs (e.g. root):
# Max Kalus (c) 2009
# */5 * * * * /[path_to_this_file]/updateindex.sh
if [ -f /var/run/searchd.pid ];
then
	/usr/bin/indexer --quiet --config /etc/sphinx-search/sphinx.conf --rotate histcross_vertices
	/usr/bin/indexer --quiet --config /etc/sphinx-search/sphinx.conf --rotate histcross_relations
fi
