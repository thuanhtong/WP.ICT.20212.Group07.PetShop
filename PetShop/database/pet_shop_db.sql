-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: pet_shop_db
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `inventory_id` int NOT NULL,
  `price` double NOT NULL,
  `quantity` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(250) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Food','Food Description',1,'2022-07-21 10:17:41'),(2,'Accessories','&lt;p&gt;Accessories Category&lt;/p&gt;',1,'2022-07-21 10:34:04');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `default_delivery_address` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Anh','Tong','Female','0987654321','xxxthuanhxxx@gmail.com','e10adc3949ba59abbe56e057f20f883e','Hanoi','2022-07-24 15:38:25'),(3,'user','user','Male','09876543210','user@gmail.com','ee11cbb19052e40b07aac0ca060c23ee','Hanoi','2022-07-24 19:12:51');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` double NOT NULL,
  `unit` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `size` varchar(250) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,1,48,'Pack',21.79,'M','2022-07-21 13:01:30','2022-07-24 17:16:30'),(2,1,22,'Pack',36.69,'L','2022-07-21 13:07:00','2022-07-24 17:16:30'),(3,4,56,'pcs',44.49,'M','2022-07-21 16:50:37','2022-07-24 17:16:30'),(4,3,75,'Pack',18.9,'M','2022-07-21 16:51:12','2022-07-24 17:16:30'),(5,5,34,'pcs',11.99,'M','2022-07-21 16:51:35','2022-07-24 17:23:49'),(6,4,26,'pcs',113.24,'L','2022-07-21 16:51:54','2022-07-24 17:16:30'),(7,6,64,'pcs',24.63,'S','2022-07-22 15:50:47','2022-07-24 17:21:04'),(8,6,85,'pcs',32.89,'M','2022-07-22 15:51:13','2022-07-24 17:20:32'),(10,2,56,'Pack',8.43,'S','2022-07-24 16:59:01',NULL),(11,2,14,'Pack',15.29,'M','2022-07-24 16:59:26','2022-07-24 17:06:32'),(12,4,66,'pcs',36.54,'S','2022-07-24 17:15:34',NULL),(13,7,62,'Pack',30.3,'M','2022-07-24 17:43:21',NULL),(14,7,98,'Pack',15.19,'S','2022-07-24 17:43:43',NULL),(15,8,62,'pcs',17.52,'M','2022-07-24 17:49:52',NULL),(16,8,34,'pcs',26.54,'L','2022-07-24 17:50:12',NULL),(17,9,12,'pcs',38.99,'S','2022-07-24 17:55:47',NULL),(18,9,4,'pcs',52.99,'M','2022-07-24 17:56:28',NULL),(19,10,28,'Pack',8.04,'S','2022-07-24 18:00:36',NULL),(20,10,16,'Pack',12.46,'M','2022-07-24 18:01:15',NULL),(21,11,32,'Pack',10.96,'M','2022-07-24 18:06:35',NULL),(22,11,16,'Pack',18.66,'L','2022-07-24 18:06:58',NULL),(23,12,17,'pcs',9.99,'S','2022-07-24 18:14:51',NULL),(24,13,8,'pcs',15.99,'M','2022-07-24 18:21:02',NULL),(25,13,16,'pcs',12.62,'S','2022-07-24 18:21:27',NULL),(26,14,22,'Pack',8.99,'S','2022-07-24 18:38:04',NULL),(27,14,33,'Pack',13.69,'M','2022-07-24 18:38:27',NULL),(28,16,8,'set',15.98,'S','2022-07-24 18:45:20',NULL),(29,15,27,'Pack',11.29,'S','2022-07-24 18:46:35',NULL),(30,15,14,'Pack',16.79,'M','2022-07-24 18:46:54',NULL),(31,17,6,'set',74.99,'NONE','2022-07-24 18:50:52',NULL);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_list`
--

DROP TABLE IF EXISTS `order_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(20) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_list`
--

LOCK TABLES `order_list` WRITE;
/*!40000 ALTER TABLE `order_list` DISABLE KEYS */;
INSERT INTO `order_list` VALUES (1,1,2,'M','Pack',1,15.29,15.29),(2,1,1,'L','Pack',1,36.69,36.69);
/*!40000 ALTER TABLE `order_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `delivery_address` text NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'Hanoi ','cod',51.98,3,1,'2022-07-24 17:06:32','2022-07-24 17:08:22');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `sub_category_id` int NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,'Pedigree Adult Dry Dog Food','&lt;p&gt;Contains one (1) 33 lb. bag of PEDIGREE Complete Nutrition Adult Dry Dog Food, Roasted Chicken, Rice &amp;amp; Vegetable Flavor&lt;/p&gt;&lt;p&gt;This dry food recipe helps maintain a healthy lifestyle with antioxidants, vitamins, and minerals, in the delicious chicken flavor dogs love&lt;/p&gt;&lt;p&gt;Provides whole grains and helps support healthy digestion&lt;/p&gt;&lt;p&gt;Delivers complete and balanced nutrition enriched with omega-6 fatty acids to help nourish your dog&rsquo;s skin and coat&lt;/p&gt;&lt;p&gt;Made in the USA with the World&rsquo;s Finest Ingredients&lt;/p&gt;&lt;p&gt;PEDIGREE Complete Nutrition Adult Dry Dog Food is made with no high fructose corn syrup, no artificial flavors, and no added sugar&lt;/p&gt;',1,'2022-07-21 11:19:31'),(2,1,1,'Cesar Softies Dog Treats','&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;Contains one (1) 16 ounce 180-count pouch of Cesar Softies Dog Treats Medley Trio&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;Cesar Softies are bite-size gourmet soft dog treats that are ideal for all dog sizes, especially small breed dogs&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;Cesar Dog Treats contain only seven low calories to help dogs of all sizes, especially small breed dogs, stay healthy&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;Cesar Softies Baked Dog Treats have a soft texture for easy chewing&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;Cesar Softies Treats for Dogs feature three mouthwatering flavors, including porterhouse steak flavor, grilled chicken flavor and apple wood smoked bacon flavor&lt;/p&gt;',1,'2022-07-21 12:18:32'),(3,1,3,'Meow Mix Original Choice Dry Cat Food','&lt;p&gt;Contains (1) 3.15 Pound Bag of Dry Cat Food&lt;/p&gt;&lt;p&gt;Complete and balanced nutrition&lt;/p&gt;&lt;p&gt;Provides all essential vitamins and minerals&lt;/p&gt;&lt;p&gt;High quality protein helps support strong, healthy muscles&lt;/p&gt;&lt;p&gt;Made in the USA&lt;/p&gt;',1,'2022-07-21 16:48:16'),(4,2,4,'Bedsure Orthopedic Dog Bed','&lt;p&gt;Egg Crate Foam: The 3&quot; high-density egg create foam dog bed evenly distributes your pet&rsquo;s weight, which provides maximum support and comfort for pets of all ages.&lt;/p&gt;&lt;p&gt;Sofa-Style Bed Design: The 3-sided 3.5&quot; bolstered side pillow adds extra support to your pet&#039;s neck and head for a more restful sleep.&lt;/p&gt;&lt;p&gt;Cozy Spot: The sleep surface (14&rdquo;x12&rdquo;) is made of a flannel cover that provides a soft and comfortable sleeping area for dogs or cats.&lt;/p&gt;&lt;p&gt;Nonskid Bottom: The non-slip, studded plastic bottom can fix the position of your dog bed, so it brings the dog a sense of security.&lt;/p&gt;&lt;p&gt;Easy to Care: Removable cover with zip closure for easy cleaning. The inner foam has a TPU cover, which provides protection from dog pee and excrement.&lt;/p&gt;',1,'2022-07-21 16:49:07'),(5,2,5,'Interactive Cat Toy, JXFUKAL','&lt;p style=&quot;text-align: justify; &quot;&gt;?ULTRA LONG FLEXIBLE METAL WIRE: This cat toy features strong resilience, which makes the ball keeps swinging back and forth, attracting the cat to constantly jump and punch. This automatic cat toy stimulates kitty&rsquo;s hunting instinct, your cats never be bored when you go out or work.&lt;/p&gt;&lt;p style=&quot;text-align: justify; &quot;&gt;?EASY TO USE: The cat toy could be install easily on the floor(FOLLOW THE VIDEO TO INSTALL). These cats are willing to play it by themselves. This cat toy easily achieve &rdquo;automatically entertain cat&rdquo; without recharging or putting battery.&lt;/p&gt;&lt;p style=&quot;text-align: justify; &quot;&gt;?SUIT FOR ADULT CATS &amp;amp; KITTENS: The height of metal string is adjustable, from 29inch to 35inch. Whether it&rsquo;s a adult cat or a kitten, they will be obsessed with this toy; this thin metal stick is flexible and sturdy, not afraid of bending, not easy to break.&lt;/p&gt;&lt;p style=&quot;text-align: justify; &quot;&gt;?5 REPLACEABLE BALLS: This high quality ABS ball features safe &amp;amp; durable, no worries while scratching and biting the ball; The funny cat toy is equipped with 5 balls, which can be used interchangeably; It lasts long keep your cat entertained.&lt;/p&gt;&lt;p style=&quot;text-align: justify; &quot;&gt;?GREAT CAT&rsquo;S PLAYMATE: This toy could be cat&rsquo;s great partner. It helps cat to relieve loneliness &amp;amp;boredom, excise body &amp;amp; brain and consume extra energy.&lt;/p&gt;',1,'2022-07-21 16:50:11'),(6,2,4,'Gooby Comfort X Head in Harness','&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;No Choke Dog Harnesses for Small Dogs &ndash; Gooby&rsquo;s Comfort X Harness is made for small breed dogs. This means that our largest size will fit a dog up to 30 lbs. In order to fully utilize the functionality of the harness, as well as the fit, we recommend measuring the largest part of the dog&rsquo;s chest and follow the chest sizing. For reference, estimated sizing by weight is Small: 5-9 lbs Medium: 9-15 lbs Large: 15-20 lbs X-Large: 20-30 lbs.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;PATENTED CHOKE FREE X FRAME - Comfort X Harness is made with a patented choke free design with chest strap creating a X. Our no choke dog harness sits below the usual neck area, reducing the stress pressed on the neck. By placing the D ring on the back, pull trajectory is lowered, reducing the chance of harness being pulled up to choke the dog (US D823,556 S/ US D850,021 S).&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;Lightweight Mesh &ndash; Polyester soft mesh no pull harness for medium dogs and small dogs keeps the body temperature cool. It is also very light in weight and easy to take care of (just machine wash cold and air dry) ideal for an everyday use for your no pull dog harness.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;Leash Attachment - High quality metal d-ring for extra security to withstand the test of time. [Note: When choosing the correct size, we recommend measuring the largest part of the dog&#039;s chest and follow the chest sizing first and foremost. If between sizes, please size up]&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;&quot;&gt;Machine Washable - 100 % polyester mesh material allows for easy cleaning and quick air dry, saving you time and hassle.&lt;/p&gt;',1,'2022-07-22 15:50:16'),(7,1,3,'Kitzy Dry Cat Food, No Added Grains','&lt;p&gt;REAL AMERICAN TURKEY FIRST: Real meat is always the first ingredient in Kitzy dry cat food.&lt;/p&gt;&lt;p&gt;NUTRITIOUS PROTEIN RECIPE: This delicious recipe features real poultry, peas and sweet potatoes, but without added grains.&lt;/p&gt;&lt;p&gt;FOR ALL LIFE STAGES: Kitzy offers complete and balanced nutrition to fuel favorite felines of all life stages.&lt;/p&gt;&lt;p&gt;NO ADDED GRAIN: Kitzy Dry Cat Food is made without added grain, wheat, corn or soy. NO POULTRY BY-PRODUCTS, artifical colors or flavors.&lt;/p&gt;&lt;p&gt;TRANSITION GUIDANCE: To avoid dietary upsets while transitioning to Kitzy, mix a small amount of our dry cat food with your cat&rsquo;s previous food over a period of 7-10 days, increasing the ratio of Kitzy to previous food each day.&lt;/p&gt;&lt;p&gt;Kitzy dry cat food is made at a family-owned facility in Arkansas, USA, with high-quality ingredients from around the world.&lt;/p&gt;&lt;p&gt;If you like Blue Buffalo Dry Cat Food, we invite you to try Kitzy.&lt;/p&gt;',1,'2022-07-24 17:40:00'),(8,1,3,'Purina Friskies Wet Cat Food','&lt;p&gt;2 Packs of twelve 5.5-ounce cans(total of 132-ounces)&lt;/p&gt;&lt;p&gt;Finely ground to a smooth texture&lt;/p&gt;&lt;p&gt;Contains artificial, natural flavors and salt&lt;/p&gt;&lt;p&gt;100% complete &amp;amp; Balanced for growth of kittens and maintenance of adult cats&lt;/p&gt;',1,'2022-07-24 17:47:14'),(9,2,5,'Scurrty Xpect Cat Carrier','&lt;p&gt;【Specifications】Cat carrier Backpack size: 16.9&rdquo; *12.9&rdquo; *9&rdquo;, come with a Free Gift: Collapsible Bowl. airline approved, recommended for long-term use, suggest weight: 13lbs for cat and 11lbs for dog.&lt;/p&gt;&lt;p&gt;【Breathable】Nine-hole design for better air permeability. Oxford cloth material, safe and non-toxic, no need to worry about damage done by clawing or gnawing, ensure cats comfort. Internal fastening buckles can effectively prevent cat from escaping.&lt;/p&gt;&lt;p&gt;【Durable material】Solid ABS plastic material, able to being waterproof and anti-scratch, with a protective film on the surface to prevent surface from being damaged, it can be torn off before use.&lt;/p&gt;&lt;p&gt;【Built-in lock】This pet bubble carrier is equipped with a safety lock to protect the pet from escaping when opening the backpack.&lt;/p&gt;&lt;p&gt;【Ergonomic design】With air mesh back, it can absorb sweat and breathe more freely. The wider shoulder belt can relieve the pressure from the backpack and effectively increase the comfort level of human body. Rubber handheld features make travel easier.&lt;/p&gt;',1,'2022-07-24 17:53:26'),(10,1,6,'Versele-Laga Complete All-in-One Adult Rabbit Food','&lt;p&gt;Non-GMO&lt;/p&gt;&lt;p&gt;Colors sourced from grasses, herbs and vegetables&lt;/p&gt;&lt;p&gt;No artificial flavors or preservatives&lt;/p&gt;&lt;p&gt;No added sugars&lt;/p&gt;&lt;p&gt;Long fibers&lt;/p&gt;&lt;p&gt;Note: Products with electrical plugs are designed for use in the US. Outlets and voltage differ internationally and this product may require an adapter or converter for use in your destination. Please check compatibility before purchasing.&lt;/p&gt;',1,'2022-07-24 17:58:20'),(11,1,6,'Sunseed Vita Prima Young Rabbit Food','&lt;p&gt;Alfalfa-based formula provides extra protein &amp;amp; calcium for young, growing rabbits&lt;/p&gt;&lt;p&gt;No artificial colors, flavors, or preservatives&lt;/p&gt;&lt;p&gt;Ingredient variety encourages natural foraging&lt;/p&gt;&lt;p&gt;Made with our unique nutrient-rich blend of ancient grains&lt;/p&gt;&lt;p&gt;Fortified with essential Vitamins A, D, and E&lt;/p&gt;',1,'2022-07-24 18:02:25'),(12,2,7,'ANIAC Small Animals Hat Rabbit Cap','&lt;p&gt;Size: Height-2 Inch, External diameter-5 Inch,Inner diameter-3 Inch,suitable for small breeds, such as rabbits,kitty, mini dog, adult guinea pig, ferret and similar sized animals.&lt;/p&gt;&lt;p&gt;Made of quality cotton, soft and comfortable for your pets to wear&lt;/p&gt;&lt;p&gt;Adjustable chin strap and ear holes design make it more sturdy on you pet head , also easy to take on and off . suit for birthday, holiday, wedding ,chirstmas ,holloween and various occaisons&lt;/p&gt;&lt;p&gt;Bright yellow color will attract more eyeballs for your pet ,and suit for all season , summer for sun protective and for keeping warm in winter&lt;/p&gt;&lt;p&gt;Package:1*hat+1*ANIAC bookmark&lt;/p&gt;',1,'2022-07-24 18:07:52'),(13,2,7,'RANYPET Bunny Bed Warm','&lt;div&gt;PERFECT HOUSE FOR SMALL PETS: The bunny cave bed offers your lovely little pets a private, warm and comfortable hideaway, brings them a sense of security and safety. Your furry little friend could play ,rest, hide, sleep or do other activties in this safe shelter, which is also treated as a cozy home.&lt;/div&gt;&lt;div&gt;CUTE LITTLE TENT: Exterior : 35cm height, 30cm length, 30cm width; Entrance: 17cm width, 15cm height. A removable soft cushion inside, this pet bed can be used as a cozy covered hideout cave or folded into a lovely pet sofa. Putting the cushion or other blanket on it , your little pet can snuggle with it for maximum comfort.&lt;/div&gt;&lt;div&gt;PREMIUM MATERIAL: Made of high quality, odor-free, and eco-friendly materials, including high-grade fabric cover and high resilience PP cotton filling. Sturdy structural, love pattern, cute bowknot and anti slip design at the bottom make the cage bed more pratical and popular.&lt;/div&gt;&lt;div&gt;EASY CARE: Separated mat inside, convenient to wash. you will never fear the pet cave bed stains easily due to the gray apperance. This rabbit bed can be both hand and machine washable and dryer friendly.&lt;/div&gt;&lt;div&gt;GREAT SIZE: Wide Entrance Design provides access easily.Big enough for 2 Guinea Pigs or 1 Adult Dwarf Rabbits. Ideal for Guinea Pigs, Rabbits, Bunnies, Ferrets, Chinchillas, Degus, and other small pet.&lt;/div&gt;',1,'2022-07-24 18:16:32'),(14,1,8,'Supreme Tiny Friends Farm Hazel Hamster Tasty','&lt;p&gt;A Nutritionally Balanced, Tasty Mix For Hamsters&lt;/p&gt;&lt;p&gt;Promotes Natural Foraging&lt;/p&gt;&lt;p&gt;Best Ever Taste - No Added Sugar&lt;/p&gt;&lt;p&gt;Added Vitamins For Health &amp;amp; Vitality&lt;/p&gt;&lt;p&gt;Suitable For All Breeds Including Dwarf Hamsters&lt;/p&gt;',1,'2022-07-24 18:35:35'),(15,1,8,'Beaphar Care Plusfor Hamsters','&lt;p&gt;Supplied by littleBigPet one of the UK&#039;s leading Small Animal Retailers&lt;/p&gt;&lt;p&gt;Huge Range of Pet Supplies at discounted prices&lt;/p&gt;',1,'2022-07-24 18:39:27'),(16,2,10,'Sofier Hamster Chew Toys Set 11 Pack Natural Wooden','&lt;div&gt;【11 Models of Wooden Chew Toys】The hamster toys and accessories set includes Watermelon Balls, Bell Roller, Dumbbell, Unicycle, Square Molar Block with Rope, Bell Swing, Climbing Ladder, Carrot, Willow Rattan Ball, Seesaw and Molar String. Offers a cool playground for hamsters,dwarf hamsters,rats,guinea pigs,parrots,chinchillas,gerbils,sugar gliders and bunny rabbits.&lt;/div&gt;&lt;div&gt;【Entertain&amp;amp;Exercise】This natural wooden toys set includes the carrot chew toy and the interesting and exercising toys like the bell roller,swing and seesaw. Those stuff can be very attractive for most of the hamsters. Also perfect guinea pig toys.They will be thrilled and have a good time playing and chewing.&lt;/div&gt;&lt;div&gt;【Natural&amp;amp;Safe】The toys for hamster are made of 100% natural wood, safe and durable for chewing and biting. Let your pets to have a lot of fun in their own place.&lt;/div&gt;&lt;div&gt;【Durable Molar Tools】The exquisitely shaped hamster chew toys are eco-friendly as well as bite-resistant. Functioning as molar tools for your pets to play and work out! Keeping them healthy and active.&lt;/div&gt;&lt;div&gt;【Perfet Gift for Pets】The natural hamster toys kit is suitable for small pets, like hamsters and guinea pigs, helping them to grind down their constantly growing teeth as well as preventing your pets from chewing their cage and other furniture. A perfect gift for your pet.&lt;/div&gt;',1,'2022-07-24 18:41:50'),(17,2,10,'Ferplast HAMSTERVILLE Hamster Habitat Cage','&lt;div&gt;Beautiful Natural Wood Hamster Cage | Unique hamster cage is made with all natural, sustainable, liquid resistant wood &amp;amp; a robust wire net structure&lt;/div&gt;&lt;div&gt;Hamster Cage Includes All Accessories | Hamsterville comes equipped with a plastic 5.5&quot; exercise wheel, .04-gallon plastic water bottle, plastic food dish, hamster hide-out, 3 wood platforms &amp;amp; ladders&lt;/div&gt;&lt;div&gt;Easy Maintenance Wood Hamster Cage | A 2.6&quot; deep plastic base contains bedding &amp;amp; can be removed to dump litter / etc. for routine cleaning, other plastic accessories &amp;amp; wire top can be cleaned with a mild, hamster-safe detergent, removable plastic base measures 22.75L x 12.25W x 2.6H inches&lt;/div&gt;&lt;div&gt;Convenient Front &amp;amp; Top Door Access | Simply lift the top door to gain access to your hamster &amp;amp; the accessories for cleaning or food / water refills&lt;/div&gt;',1,'2022-07-24 18:48:15');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `total_amount` double NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,1,1100,'2022-07-22 13:48:54'),(4,4,51.98,'2022-07-24 17:06:32');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sizes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `size` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,'xs'),(2,'s'),(3,'m'),(4,'l'),(5,'xl'),(6,'None');
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `sub_category` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (1,1,'Dog Food','&lt;p&gt;Sample only&lt;/p&gt;',1,'2022-07-21 10:58:32'),(3,1,'Cat Food','&lt;p&gt;Sample&lt;/p&gt;',1,'2022-07-21 16:34:59'),(4,2,'Dog Needs','&lt;p&gt;Sample&amp;nbsp;&lt;/p&gt;',1,'2022-07-21 16:35:26'),(5,2,'Cat Needs','&lt;p&gt;Sample&lt;/p&gt;',1,'2022-07-21 16:35:36'),(6,1,'Rabbit Food','&lt;p&gt;Food for Rabbit&lt;/p&gt;',1,'2022-07-24 16:35:01'),(7,2,'Rabbit Needs','&lt;p&gt;Accessories for Rabbit&lt;br&gt;&lt;/p&gt;',1,'2022-07-24 16:35:56'),(8,1,'Hamster Food','&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Food for&amp;nbsp;&lt;/span&gt;Hamster&amp;nbsp;&lt;br&gt;&lt;/p&gt;',1,'2022-07-24 16:36:28'),(9,1,'Bird Food','&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Food for&amp;nbsp;&lt;/span&gt;Bird&amp;nbsp;&lt;br&gt;&lt;/p&gt;',0,'2022-07-24 16:37:42'),(10,2,'Hamster Needs','&lt;p&gt;Accessories for&amp;nbsp;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Hamster&lt;/span&gt;&lt;br&gt;&lt;/p&gt;',1,'2022-07-24 16:38:18');
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_info`
--

LOCK TABLES `system_info` WRITE;
/*!40000 ALTER TABLE `system_info` DISABLE KEYS */;
INSERT INTO `system_info` VALUES (1,'name','Murphy&apos;s Market for Your Sweetie Pet'),(2,'short_name','Murphy&apos;s Pet'),(3,'logo','uploads/pet-logo.png'),(4,'user_avatar','uploads/avatar.png'),(5,'cover','uploads/banner.jpg');
/*!40000 ALTER TABLE `system_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adminstrator','Admin','admin','21232f297a57a5a743894a0e4a801fc3','uploads/avatar.png',NULL,1,'2022-07-20 14:02:37','2022-07-24 19:11:52'),(2,'Anh','Tong','anhttt','e10adc3949ba59abbe56e057f20f883e','uploads/meo.jpg',NULL,0,'2022-07-21 08:36:09','2022-07-24 16:13:50'),(3,'Giang','Nguyen','giangntt','e10adc3949ba59abbe56e057f20f883e','uploads/meo2.jpg',NULL,0,'2022-07-21 10:01:51','2022-07-24 16:17:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-24 19:14:02
