mysqldump -u root -proot -h localhost meto-prod | mysql -u root -proot -h localhost meto-test && mysql -u root -proot -h localhost meto-test -e "update meto_users set password = '\$2y\$10\$nLPI94.NnBeFSzLbaLJ75eNNWrg.aCuVLa0ONfuJk2i8HVW/0n79u';"