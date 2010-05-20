@ECHO OFF & SETLOCAL
PUSHD %~dp0

ECHO Now we start the Indexer once to update database
cd sphinx
bin\indexer.exe --all

ECHO Now we start Sphinx
bin\searchd.exe

POPD
PAUSE