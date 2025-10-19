-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2025 at 04:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paw_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_logs`
--

CREATE TABLE `chat_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `response_time` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `chat_session_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_logs`
--

INSERT INTO `chat_logs` (`id`, `user_id`, `question`, `answer`, `category`, `response_time`, `created_at`, `updated_at`, `chat_session_id`) VALUES
(2, 3, 'when is it safe to bathe a kitten?', 'Kittens and puppies can safely be bathed after about 8 weeks of age. Use lukewarm water, pet-safe shampoo, and dry them thoroughly to prevent chills.<div style=\'margin-top:10px; padding:8px; border-left:3px solid #ddd;\'>\n                            <strong>👉 You can also ask:</strong><br>\n                            <ul style=\'margin-top:5px; padding-left:20px;\'></ul></div>', 'Bathing pet first', 0.011814832687378, '2025-10-01 07:13:29', '2025-10-01 07:13:29', NULL),
(3, 3, 'when can i give my puppy his first bath?', 'Kittens and puppies can safely be bathed after about 8 weeks of age. Use lukewarm water, pet-safe shampoo, and dry them thoroughly to prevent chills.<div style=\'margin-top:10px; padding:8px; border-left:3px solid #ddd;\'>\n                            <strong>👉 You can also ask:</strong><br>\n                            <ul style=\'margin-top:5px; padding-left:20px;\'></ul></div>', 'Bathing pet first', 0.018168926239014, '2025-10-01 07:13:53', '2025-10-01 07:13:53', NULL),
(30, 6, 'bathing pet first', 'I\'m not sure how to respond to: \"bathing pet first\"', 'General', 0.012012958526611, '2025-10-03 00:56:54', '2025-10-03 00:56:54', NULL),
(255, 14, 'what is the lifesspan of a doh', 'Even the smartest pup gets confused sometimes! 🐕 Can you try rephrasing your question? I\'m here to help with all your pet needs.', 'Default Fallback Intent', 2.0054569244385, '2025-10-13 21:01:35', '2025-10-13 21:01:35', 80),
(256, 14, 'what is the lifespan of a dog', 'Playing with your dog strengthens your bond and provides essential mental and physical stimulation. Great games include fetch, tug-of-war (with clear rules like \'drop it\' command), hide-and-seek with toys or treats, and learning new tricks. Keep sessions positive and end before your dog gets overtired. Watch for appropriate play styles - if your dog becomes too excited or mouthy, take a break. Different breeds and ages have varying play preferences, so experiment to discover what your dog enjoys most while maintaining safe, controlled interactions.', 'Activity - Playing with Dog', 1.9031200408936, '2025-10-13 21:02:00', '2025-10-13 21:02:00', 80),
(257, 14, 'what is pharvo?', 'Hmm, I don\'t have an answer for that yet. Please ask me about something to do with your pet!', 'Default Fallback Intent', 1.5873630046844, '2025-10-13 21:04:44', '2025-10-13 21:04:44', 80),
(258, 14, 'vaccination for dogs', 'Core puppies typically require a series of vaccinations every 2-3 weeks starting at 6-8 weeks old and continuing until about 16-20 weeks old. For adult dogs, booster shots are often given annually or every three years, depending on the vaccine type and your dog\'s lifestyle. However, this is a general guideline only. Your veterinarian will determine the precise vaccination schedule based on your dog\'s specific health status, local disease risks, and legal requirements for vaccines like rabies.', 'Vaccine Schedules - Puppy', 1.4984991550446, '2025-10-13 21:05:10', '2025-10-13 21:05:10', 80),
(259, 14, 'my dog is having a period', 'Playing with your dog strengthens your bond and provides essential mental and physical stimulation. Great games include fetch, tug-of-war (with clear rules like \'drop it\' command), hide-and-seek with toys or treats, and learning new tricks. Keep sessions positive and end before your dog gets overtired. Watch for appropriate play styles - if your dog becomes too excited or mouthy, take a break. Different breeds and ages have varying play preferences, so experiment to discover what your dog enjoys most while maintaining safe, controlled interactions.', 'Activity - Playing with Dog', 2.931510925293, '2025-10-13 21:05:34', '2025-10-13 21:05:34', 80),
(260, 14, 'can i bath my cat?', 'If no skin condition is present, you can bathe your dog every 4-6 weeks. Bathing no more than once a week is generally safe, but over-bathing can strip natural oils and irritate their skin. Always use pet-specific shampoos, not human shampoos.', 'Bathing Pet - Frequency Dogs', 1.6112859249115, '2025-10-13 21:08:23', '2025-10-13 21:08:23', 80),
(261, 14, 'how many days before pregnancy of my dog?', 'Determining the right amount to feed depends on several individual factors including your Dog\'s ideal weight, age, breed, activity level, and the specific caloric content of their food. Always use the feeding guidelines on your pet food packaging as an initial reference, then monitor their body condition and adjust accordingly to maintain a healthy weight. This is a general starting point. For a precise feeding plan tailored to your pet\'s specific nutritional needs and health status, consultation with your veterinarian is highly recommended.', 'Diet - Feeding Amount', 1.7963399887085, '2025-10-13 21:11:14', '2025-10-13 21:11:14', 80),
(262, 14, 'my dog is 3 months old and his weight is half kilo', 'Weight management involves portion control, scheduled feedings, and regular exercise. For safe weight loss, dogs should aim to lose 1-2% of body weight per week, while cats should lose more slowly (0.5-1% per week) to avoid hepatic lipidosis. Your veterinarian can create a personalized weight management plan with the right diet and exercise regimen, as rapid weight loss or improper dieting can be dangerous. They can also rule out underlying medical conditions that may contribute to weight gain.', 'Diet - Weight Management', 10.200463056564, '2025-10-13 21:13:45', '2025-10-13 21:13:45', 80),
(263, 14, 'what is cat litter?', 'Temporary litter alternatives include paper, sand, or soil, but be aware of risks: poor odor control may cause house soiling, and some cats may reject unfamiliar materials. Absolutely avoid: clumping clay substitutes, scented products, or fine dust that can harm respiratory health. These should only be used for 24-48 hours maximum. If your cat has medical conditions like asthma or urinary issues, contact your veterinarian immediately for guidance, as litter changes can exacerbate health problems.', 'Litter - Litter Box Alternatives', 22.528789043427, '2025-10-13 21:14:56', '2025-10-13 21:14:56', 80),
(265, 14, 'I need your help please', 'Important Limitations:\n\n❌ I cannot diagnose medical conditions\n\n❌ I cannot prescribe treatments or medications\n\n❌ I cannot handle emergencies\n\n✅ I can provide general pet care information\n\nFor the symptoms you described, you need:\n\nImmediate veterinary consultation\n\nProfessional medical assessment\n\nPossible diagnostic testing\n\nAppropriate treatment plans\n\nPlease contact your veterinarian now. Your pet\'s health deserves professional care.', 'Bot Limitations', 1.3578758239746, '2025-10-13 21:18:03', '2025-10-13 21:18:03', 80),
(266, 14, 'my cat didn\'t eat and drink 24 hours and if they walk or stand they are wobbly or fall down.', 'Daily water needs vary by species, size, and activity level. A general guideline is 50-60 ml per kg of body weight for dogs. Cats typically have a lower thirst drive and benefit from wet food to supplement their moisture intake. To encourage hydration, provide fresh water in multiple clean locations, consider using a pet fountain, or add water to meals. Dehydration can become serious quickly, especially in seniors, and changes in drinking habits may indicate underlying health issues. If you\'re concerned about your pet\'s hydration, consult your veterinarian for personalized advice.', 'Nutrition - Hydration & Water Intake', 2.6767649650574, '2025-10-13 21:21:49', '2025-10-13 21:21:49', 80),
(274, 14, 'WHEN CAN I START VACCINATE MY PUPPY', 'Kittens need vaccines every 3-4 weeks from 6-8 weeks until about 4 months old. Adult cats require boosters every 1-3 years based on vaccine type and lifestyle. Please remember this is an educational guideline only. Your veterinarian\'s specific recommendations for your cat\'s vaccination schedule are medically essential and should always be followed.', 'Vaccine Schedules - Kitten', 1.8140139579773, '2025-10-13 21:51:14', '2025-10-13 21:51:14', 87),
(275, 14, 'ANTI TICK AND FLEA FOR DOGS', 'Flea and tick prevention should typically begin by 8 weeks of age for most puppies and kittens. Maintenance options include monthly topical treatments, oral chews, or longer-lasting 3-month products. The choice depends on your pet\'s age, health, and local parasite risks. This is general guidance - your veterinarian will recommend the most effective and safe prevention strategy tailored specifically for your pet.', 'Flea & Tick Prevention General', 1.8782639503479, '2025-10-13 21:51:51', '2025-10-13 21:51:51', 87),
(276, 14, 'CORE VACCINES IN DOG', 'Core puppies typically require a series of vaccinations every 2-3 weeks starting at 6-8 weeks old and continuing until about 16-20 weeks old. For adult dogs, booster shots are often given annually or every three years, depending on the vaccine type and your dog\'s lifestyle. However, this is a general guideline only. Your veterinarian will determine the precise vaccination schedule based on your dog\'s specific health status, local disease risks, and legal requirements for vaccines like rabies.', 'Vaccine Schedules - Puppy', 1.9241240024567, '2025-10-13 21:52:16', '2025-10-13 21:52:16', 87),
(277, 14, 'NUTRITION IN DOGS', 'Prescription therapeutic diets are medical treatments, not just food. They\'re formulated for specific conditions like kidney disease, diabetes, urinary issues, and food allergies. These diets must be prescribed by your veterinarian after proper diagnosis. Warning: Do not self-prescribe therapeutic diets, as using the wrong formulation can cause serious harm. Your veterinarian will determine which prescription diet is appropriate and monitor your pet\'s progress with regular check-ups.', 'Nutrition - Special Medical Diets', 1.61971783638, '2025-10-13 21:52:44', '2025-10-13 21:52:44', 87),
(278, 14, 'CAN I GIVE GRAPES IN DOG', 'Many common human foods are highly toxic to pets. NEVER feed your Dog: chocolate, grapes, raisins, onions, garlic, xylitol (found in sugar-free gum/candy), alcohol, caffeine, macadamia nuts, avocado, or yeast dough. Even small amounts can cause severe illness or be fatal. If you suspect your $petet has ingested ANY toxic substance, contact your veterinarian or animal poison control immediately. Do not wait for symptoms to appear, as immediate treatment is critical.', 'Diet - Toxic Foods', 1.6417438983917, '2025-10-13 21:53:06', '2025-10-13 21:53:06', 87),
(279, 14, 'WHEN CAN I BREED MY DOG', 'Determining the right amount to feed depends on several individual factors including your Dog\'s ideal weight, age, breed, activity level, and the specific caloric content of their food. Always use the feeding guidelines on your pet food packaging as an initial reference, then monitor their body condition and adjust accordingly to maintain a healthy weight. This is a general starting point. For a precise feeding plan tailored to your pet\'s specific nutritional needs and health status, consultation with your veterinarian is highly recommended.', 'Diet - Feeding Amount', 1.4773390293121, '2025-10-13 21:53:22', '2025-10-13 21:53:22', 87),
(304, 14, 'WHat are you?', 'Paws up! It\'s your pet care assistant, Pawtulong! How can we help your fantastic furball thrive today?', 'Default Welcome Intent', 0.95310091972351, '2025-10-16 11:32:13', '2025-10-16 11:32:13', 94),
(305, 14, 'okay, help me with my cat', 'Effective cat play replicates the hunt sequence: stalk, chase, pounce, catch. Use wand toys to create erratic prey-like movements, gradually building excitement before allowing successful \'captures.\' Schedule play during natural activity peaks (dawn/dusk) and end sessions before frustration sets in. For cats uninterested in toys, try crinkly objects, cardboard boxes, or food-dispensing puzzles. Important: Never use hands as toys, as this teaches inappropriate biting. If your cat\'s play behavior suddenly changes, consult your veterinarian to rule out pain or medical issues affecting their mobility or interest.', 'Activity - Playing with Cat', 0.95351696014404, '2025-10-16 11:32:33', '2025-10-16 11:32:33', 94),
(306, 14, 'My cat is not eating, what should i do?', 'Seek immediate veterinary care for any of these emergency signs: difficulty breathing, repeated vomiting/diarrhea, injury or trauma, seizures, bloated/distended abdomen, inability to urinate, sudden collapse, or signs of extreme pain. Cat often hide illness - not eating for 24+ hours or sudden behavior changes can indicate serious issues. This list highlights common emergencies, but when in any doubt about your Cat\'s condition, always contact your veterinarian or emergency clinic immediately for guidance.', 'Emergency General', 1.6294100284576, '2025-10-18 05:03:37', '2025-10-18 05:03:37', 94),
(308, 19, 'well hello there', 'Hey there! Pawtulong here, ready to help you and your beloved pet. What\'s on your mind? 😊', 'Default Welcome Intent', 1.1654539108276, '2025-10-18 05:07:34', '2025-10-18 05:07:34', 96);

-- --------------------------------------------------------

--
-- Table structure for table `chat_sessions`
--

CREATE TABLE `chat_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_sessions`
--

INSERT INTO `chat_sessions` (`id`, `user_id`, `session_name`, `created_at`, `updated_at`) VALUES
(80, 14, 'what is the lifesspan of a doh', '2025-10-13 20:59:49', '2025-10-13 21:21:49'),
(87, 14, 'WHEN CAN I START VACCINATE MY PUPPY', '2025-10-13 21:50:43', '2025-10-13 21:53:22'),
(94, 14, 'WHat are you?', '2025-10-16 11:32:05', '2025-10-18 05:03:37'),
(96, 19, 'well hello there', '2025-10-18 05:07:26', '2025-10-18 05:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_16_083712_create_products_table', 2),
(5, '2025_09_16_104814_add_username_to_users_table', 3),
(6, '2025_09_16_105334_add_username_and_user_type_to_users_table', 4),
(7, '2025_09_16_105822_drop_name_from_users_table', 5),
(8, '2025_10_01_143726_create_chat_logs_table', 6),
(9, '2025_10_03_112825_create_chat_sessions_table', 7),
(10, '2025_10_03_113043_add_chat_session_id_to_chat_logs_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image_path`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(11, 'Quantum DHLPPi', 'A multivalent vaccine protecting dogs from Distemper, Adenovirus type 2, Parvovirus, Parainfluenza, and Leptospira.	Administered for broad-spectrum protection against life-threatening canine diseases.', 'img/1760260457_quan.png', 'Vaccines', 1, '2025-10-12 01:14:17', '2025-10-14 08:18:21'),
(12, 'Zoetis Vanguard DHLPP', 'A 5-in-1 canine vaccine protecting against Distemper, Hepatitis (Adenovirus), Leptospirosis, Parvovirus, and Parainfluenza.	Used for core immunization in dogs to prevent viral and bacterial infections affecting respiratory, liver, and gastrointestinal systems.', 'img/1760260528_ze=oetis.jpg', 'Vaccines', 1, '2025-10-12 01:15:28', '2025-10-14 08:18:05'),
(13, 'Nobivac DHPPi', 'Combination vaccine for Canine Distemper, Adenovirus, Parvovirus, and Parainfluenza.	Used in puppies and adult dogs for prevention of core infectious diseases.', 'img/1760260663_nobivac.png', 'Vaccines', 1, '2025-10-12 01:17:43', '2025-10-14 08:17:50'),
(14, 'Eurican DHPPi', 'A 4-in-1 vaccine that covers Distemper, Hepatitis, Parvovirus, and Parainfluenza.	Prevents major viral infections in dogs; part of the core vaccination series.', 'img/1760260704_eurican.jpg', 'Vaccines', 1, '2025-10-12 01:18:24', '2025-10-14 08:17:34'),
(15, 'Canigen DHPPi', '4-in-1 vaccine similar to Nobivac DHPPi.	Provides comprehensive viral protection and is often used in annual boosters.', 'img/1760260787_canigen.jpg', 'Vaccines', 1, '2025-10-12 01:19:47', '2025-10-14 08:17:07'),
(16, 'Rabisin', 'A killed-virus rabies vaccine.	Provides safe and effective protection against rabies for both dogs and cats.', 'img/1760260872_rabisin.jpg', 'Vaccines', 1, '2025-10-12 01:21:12', '2025-10-14 08:16:43'),
(17, 'Defensor', 'Inactivated rabies vaccine for dogs and cats.	Used for rabies prevention and compliance with local vaccination laws.', 'img/1760260930_defensor.jpg', 'Vaccines', 1, '2025-10-12 01:22:10', '2025-10-14 08:16:19'),
(18, 'Rabvac 3', 'Inactivated rabies vaccine offering three-year protection.	Administered for long-term rabies prevention in dogs and cats.', 'img/1760260999_rabvac 3.jpg', 'Vaccines', 1, '2025-10-12 01:23:19', '2025-10-14 08:15:59'),
(19, 'Nobivac Rabies', 'Inactivated rabies vaccine by MSD Animal Health.	Used for primary and booster immunization against rabies.', 'img/1760261064_Nobican Rabies.jpg', 'Vaccines', 1, '2025-10-12 01:24:24', '2025-10-14 08:15:39'),
(20, 'Bronchicine', 'Monovalent vaccine targeting Bordetella bronchiseptica. Used when specific Bordetella protection is required or for outbreak control.', 'img/1760261154_Broncichine.jpg', 'Vaccines', 1, '2025-10-12 01:25:54', '2025-10-14 08:15:20'),
(21, 'Pneumodog', 'Injectable or intranasal vaccine for respiratory pathogens.	Provides respiratory protection against kennel cough complex.', 'img/1760261176_Pneumodog.jpg', 'Vaccines', 1, '2025-10-12 01:26:16', '2025-10-14 08:14:53'),
(22, 'Nobivac KC', 'Intranasal vaccine for Bordetella bronchiseptica and Canine Parainfluenza Virus.	Used to prevent kennel cough in dogs, especially those in boarding or grooming facilities.', 'img/1760261197_Novicac KC.jpg', 'Vaccines', 1, '2025-10-12 01:26:37', '2025-10-14 08:14:28'),
(23, 'Wormguard (Pyrantel + Praziquantel + Febantel)', 'Triple-action dewormer.	Effective against most intestinal worms, used in routine deworming schedules.', 'img/1760261362_Wormguard.png', 'Dewormers', 1, '2025-10-12 01:29:22', '2025-10-14 08:13:22'),
(24, 'Prazinate Syrup / Tablet (Pyrantel + Praziquantel)', 'Oral dewormer combination.	Used to eliminate tapeworms and roundworms in dogs and cats.', 'img/1760261415_Prazinate.jpg', 'Dewormers', 1, '2025-10-12 01:30:15', '2025-10-14 08:13:07'),
(25, 'Drontal / Drontal Plus (Praziquantel + Pyrantel / Febantel)', 'Multi-active dewormer.	\r\nUsed to eliminate roundworms, tapeworms, and whipworms in dogs.', 'img/1760261442_Drontal.jpg', 'Dewormers', 1, '2025-10-12 01:30:42', '2025-10-14 08:12:47'),
(26, 'Panacur (Fenbendazole)', 'Broad-spectrum dewormer targeting roundworms, hookworms, whipworms, and some tapeworms.', 'img/1760261482_Panacur.jpg', 'Dewormers', 1, '2025-10-12 01:31:22', '2025-10-14 08:12:23'),
(27, 'Milbemax (Milbemycin oxime + Praziquantel)', 'Oral tablet for broad-spectrum parasite control.', 'img/1760261506_milbemax.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:31:46', '2025-10-14 08:11:54'),
(28, 'Profender (Emodepside + Praziquantel – topical)', 'Topical broad-spectrum dewormer for cats, effective against roundworms and tapeworms.', 'img/1760261634_profender.jpg', 'Dewormers', 1, '2025-10-12 01:33:54', '2025-10-14 08:11:34'),
(30, 'Nexgard (Afoxolaner – 1 month)', 'A chewable tablet with Afoxolaner, another isoxazoline insecticide and acaricide.', 'img/1760261951_nexgard.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:39:11', '2025-10-14 08:11:08'),
(31, 'Nexgard Spectra (Afoxolaner + Milbemycin Oxime – 1 month) –', 'Combines Afoxolaner (for fleas/ticks) and Milbemycin Oxime (for intestinal worms and heartworm).', 'img/1760261975_nextgard spectra.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:39:35', '2025-10-14 08:10:50'),
(32, 'Simparica (Sarolaner – 1 month)', 'A triple-action chew combining flea, tick, heartworm, and intestinal worm prevention.', 'img/1760262007_simparica.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:40:07', '2025-10-14 08:10:31'),
(33, 'Simparica Trio (Sarolaner + Moxidectin + Pyrantel – 1 month)', 'Monthly flea/tick prevention plus heartworm and intestinal parasite control.', 'img/1760262026_simparica trio.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:40:26', '2025-10-14 08:01:57'),
(34, 'Credelio (Lotilaner – 1 month)', 'A chewable tablet containing Lotilaner, an isoxazoline compound.	Provides monthly protection against fleas and ticks with a fast kill rate. Commonly prescribed for dogs sensitive to other oral preventives.', 'img/1760262049_credelio.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:40:49', '2025-10-14 08:42:09'),
(35, 'Advocate (No tick preventive)', 'A topical solution that kills fleas, ear mites, and intestinal worms; it prevents heartworm disease but does not protect against ticks.', 'img/1760262066_advocate.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:41:06', '2025-10-14 08:09:55'),
(36, 'Bravecto (Fluralaner – 12 weeks)', 'An oral or topical flea and tick preventive containing Fluralaner, an isoxazoline compound that kills parasites by targeting their nervous system.', 'img/1760262172_bravecto.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:42:52', '2025-10-14 08:09:39'),
(37, 'Frontline / Frontline Plus', 'A topical product; Fipronil kills adult fleas and ticks, and (S)-methoprene prevents flea egg and larval development', 'img/1760262263_frontline plus.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:44:23', '2025-10-14 08:07:57'),
(38, 'Advantage (Imidacloprid – 1 month, fleas only)', 'Monthly flea control; no tick protection. A topical treament using Imidacloprid to kill adult fleas on contact (not through bites).', 'img/1760262286_advantage.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:44:46', '2025-10-14 08:06:59'),
(39, 'Revolution (Selamectin – fleas, mites, heartworm)', '– Monthly topical for fleas, some ticks, mites, and heartworm. Topical Parasiticide containing Selamectin effective against fleas, mites, heartworm and some intestinal worms.', 'img/1760262311_revolution.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:45:11', '2025-10-14 08:05:59'),
(40, 'Seresto Collar', 'Long-term flea and tick prevention. Long-acting collar that releases Imidacloprid (kills fleas) and Flumethrin (repels/kills ticks)', 'img/1760410028_seresto.jpg', 'Tick & Flea Preventives', 1, '2025-10-12 01:46:01', '2025-10-14 08:04:58'),
(44, 'Scalibor Collars', 'A collar containing Deltamethrin, a pyrethroid insecticide.	Provides 6 months of protection against ticks, sandflies, and mosquitoes. Often recommended in areas with vector-borne diseases (e.g., leishmaniasis).', 'img/1760623877_scalibor.jpg', 'Tick & Flea Preventives', 1, '2025-10-16 06:11:17', '2025-10-18 05:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Vh9MeHndCKEVA9hkHSaQQEADgGAaxBwr1qXi4MOK', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaHlrOEtta1BLdHJaVEI2UTNlZVc4djdxbDl2Y1dJQ05MTmlPeHdvbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYW5kaW5nIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTQ7fQ==', 1760795404),
('VLMNuByqVhYa5dQ93IclWayZppXGxCigYfDbRW7E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicjJwckxITkhsZ1BIVkV0UW5FSllBc1pXbk5RYTdNVldzT3VBTlhITSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1760792087);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','client') NOT NULL DEFAULT 'client',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Janial', 'jay@gmail.com', NULL, '$2y$12$LcL4/JPS.fkwj9BxhNml6OPyAL69liYiM9fT2BAYw3dLWw.fdmHXm', 'admin', NULL, '2025-09-16 12:21:22', '2025-10-11 11:05:03'),
(6, 'Clrshn', 'clarisahainaa@gmail.com', NULL, '$2y$12$ml116cYjmw2LeNQ6EmBow.oUHPkLIEfOtLo4MG49puQesQIVjL1yy', 'admin', NULL, '2025-09-18 06:29:21', '2025-09-18 06:29:21'),
(14, 'Janpotz', 'janjan@gmail.com', NULL, '$2y$12$oH6OTB9iHGRH09Z9cn0.n.iacRXqPzERRg.vUeQ7408H9eSZpQSKW', 'client', NULL, '2025-10-01 07:31:09', '2025-10-16 07:33:38'),
(19, 'Admin1', 'admin@example.com', NULL, '$2y$12$z2uKkpZuUToBdTjOGVVfYe0P8U8dFgxBuScjdcq7zj.QV11o5bpkq', 'admin', NULL, '2025-10-18 05:05:49', '2025-10-18 05:16:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chat_logs`
--
ALTER TABLE `chat_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_logs_user_id_foreign` (`user_id`),
  ADD KEY `chat_logs_chat_session_id_foreign` (`chat_session_id`);

--
-- Indexes for table `chat_sessions`
--
ALTER TABLE `chat_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_logs`
--
ALTER TABLE `chat_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `chat_sessions`
--
ALTER TABLE `chat_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_logs`
--
ALTER TABLE `chat_logs`
  ADD CONSTRAINT `chat_logs_chat_session_id_foreign` FOREIGN KEY (`chat_session_id`) REFERENCES `chat_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_sessions`
--
ALTER TABLE `chat_sessions`
  ADD CONSTRAINT `chat_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
