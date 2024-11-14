#!/bin/bash
set -e

# Check if the production database exists
if ! psql -U "$POSTGRES_USER" -tAc "SELECT 1 FROM pg_database WHERE datname='fd_db'" | grep -q 1; then
  echo "Creating production database (fd_db)..."
  createdb -U "$POSTGRES_USER" fd_db
fi

# Check if the test database exists
if ! psql -U "$POSTGRES_USER" -tAc "SELECT 1 FROM pg_database WHERE datname='fd_test_db'" | grep -q 1; then
  echo "Creating test database (fd_test_db)..."
  createdb -U "$POSTGRES_USER" fd_test_db
fi
