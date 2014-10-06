-- LOAD DATA LOCAL from csv files
SET SQL_SAFE_UPDATES=0;
use my_tracker;
-- Delete and LOAD DATA LOCAL from Users Table
DELETE FROM `my_tracker`.`users`;
DROP TRIGGER IF EXISTS users_update;
CREATE TRIGGER users_insert BEFORE INSERT on  `my_tracker`.`users` FOR EACH ROW SET NEW.created_date = NOW();
CREATE TRIGGER users_update BEFORE UPDATE on  `my_tracker`.`users` FOR EACH ROW SET NEW.modified_date = NOW();
LOAD DATA LOCAL INFILE 'users.csv' INTO TABLE `my_tracker`.`users` FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\n' (id,name,email,password_hash,avatar,api_key,user_status);

-- Delete and LOAD DATA LOCAL from Ingredients Table
DELETE FROM `my_tracker`.`ingredients`;
DROP TRIGGER IF EXISTS ingredients_update;
CREATE TRIGGER ingredients_insert BEFORE INSERT on  `my_tracker`.`ingredients` FOR EACH ROW SET NEW.created_date = NOW();
CREATE TRIGGER ingredients_update BEFORE UPDATE on  `my_tracker`.`ingredients` FOR EACH ROW SET NEW.modified_date = NOW();
LOAD DATA LOCAL INFILE 'ingredients.csv' INTO TABLE `my_tracker`.`ingredients` FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\n' (id,ingredient,department,islenumber);

-- Delete and LOAD DATA LOCAL from Recipes Table
DELETE FROM `my_tracker`.`recipes`;
DROP TRIGGER IF EXISTS recipes_update;
CREATE TRIGGER recipes_insert BEFORE INSERT on  `my_tracker`.`recipes` FOR EACH ROW SET NEW.created_date = NOW();
CREATE TRIGGER recipes_update BEFORE UPDATE on  `my_tracker`.`recipes` FOR EACH ROW SET NEW.modified_date = NOW();
LOAD DATA LOCAL INFILE 'recipes.csv' INTO TABLE `my_tracker`.`recipes` FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\n' (id,recipe,points,time,pic,preparation,notes);

-- Delete and LOAD DATA LOCAL from Tracker Table
SET FOREIGN_KEY_CHECKS=0;
DELETE FROM `my_tracker`.`tracker`;
DROP TRIGGER IF EXISTS tracker_update;
CREATE TRIGGER tracker_insert BEFORE INSERT on  `my_tracker`.`tracker` FOR EACH ROW SET NEW.created_date = NOW();
CREATE TRIGGER tracker_update BEFORE UPDATE on  `my_tracker`.`tracker` FOR EACH ROW SET NEW.modified_date = NOW();
LOAD DATA LOCAL INFILE 'tracker.csv' INTO TABLE `my_tracker`.`tracker` FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\n' (id,date,exercise,minutes,exercise_points,weight,breakfast,breakfast_points,lunch,lunch_points,dinner,dinner_points,snacks,snacks_points,indulgence,indulgence_points,users_id);

-- Delete and LOAD DATA LOCAL from recipes_has_ingredients Table
DELETE FROM `my_tracker`.`recipes_has_ingredients`;
LOAD DATA LOCAL INFILE 'recipes_has_ingredients.csv' INTO TABLE `my_tracker`.`recipes_has_ingredients` FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\n' (recipes_id,ingredients_id);

-- Delete and LOAD DATA LOCAL from users_has_recipes Table
DELETE FROM `my_tracker`.`users_has_recipes`;
DROP TRIGGER IF EXISTS users_has_recipes_update;
CREATE TRIGGER users_has_recipes_insert BEFORE INSERT on  `my_tracker`.`users_has_recipes` FOR EACH ROW SET NEW.created_date = NOW();
CREATE TRIGGER users_has_recipes_update BEFORE UPDATE on  `my_tracker`.`users_has_recipes` FOR EACH ROW SET NEW.modified_date = NOW();
LOAD DATA LOCAL INFILE 'users_has_recipes.csv' INTO TABLE `my_tracker`.`users_has_recipes` FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\n' (users_id,recipes_id);

SET FOREIGN_KEY_CHECKS=1;
SET SQL_SAFE_UPDATES=1;