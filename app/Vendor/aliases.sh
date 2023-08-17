ln app/vendor/Strings.php vendor/archtechx/enums/src/Strings.php

update meto_users set password = '$2y$10$Ec2p9uZLRlZIc1s8AyieNum.j/9NxpJ/ro1ouU7RRF9.j11n0U7He';

mysqldump -u root -proot -h localhost meto-prod | mysql -u root -proot -h localhost meto-test && mysql -u root -proot -h localhost meto-test -e "update meto_users set password = '\$2y\$10\$nLPI94.NnBeFSzLbaLJ75eNNWrg.aCuVLa0ONfuJk2i8HVW/0n79u';"
