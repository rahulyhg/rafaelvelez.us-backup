#!/bin/bash

#echo "(Re) Creating the database..."
#mysql -uroot       -p'Pl4t1num' < create.sql
echo "Creating data model..."
mysql -uroot -p'Pl4t1num' < model.sql
echo "Loading data..."
mysql -uroot -p'Pl4t1num' --local-infile my_tracker < load.sql


