-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2026 at 07:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_vehicle_management`
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('school_vehicle_management_cache_chart_data_30', 'O:28:\"Illuminate\\Http\\JsonResponse\":11:{s:7:\"headers\";O:50:\"Symfony\\Component\\HttpFoundation\\ResponseHeaderBag\":5:{s:10:\"\0*\0headers\";a:3:{s:13:\"cache-control\";a:1:{i:0;s:17:\"no-cache, private\";}s:4:\"date\";a:1:{i:0;s:29:\"Sun, 30 Aug 2026 18:56:13 GMT\";}s:12:\"content-type\";a:1:{i:0;s:16:\"application/json\";}}s:15:\"\0*\0cacheControl\";a:0:{}s:23:\"\0*\0computedCacheControl\";a:2:{s:8:\"no-cache\";b:1;s:7:\"private\";b:1;}s:10:\"\0*\0cookies\";a:0:{}s:14:\"\0*\0headerNames\";a:3:{s:13:\"cache-control\";s:13:\"Cache-Control\";s:4:\"date\";s:4:\"Date\";s:12:\"content-type\";s:12:\"Content-Type\";}}s:10:\"\0*\0content\";s:489:\"{\"tripTrends\":{\"labels\":[\"Week 1\",\"Week 2\",\"Week 3\",\"Week 4\",\"Week 5\"],\"datasets\":[{\"label\":\"Completed Trips\",\"data\":[0,28,0,0,0],\"borderColor\":\"#28c76f\",\"backgroundColor\":\"rgba(40, 199, 111, 0.1)\",\"tension\":0.4},{\"label\":\"Active Trips\",\"data\":[0,6,0,0,0],\"borderColor\":\"#ff9f43\",\"backgroundColor\":\"rgba(255, 159, 67, 0.1)\",\"tension\":0.4}]},\"vehicleUtilization\":{\"labels\":[\"Available\",\"In Use\",\"Maintenance\"],\"data\":[1,4,0],\"backgroundColor\":[\"#28c76f\",\"#ff9f43\",\"#ea5455\"]},\"period\":\"30\"}\";s:10:\"\0*\0version\";s:3:\"1.0\";s:13:\"\0*\0statusCode\";i:200;s:13:\"\0*\0statusText\";s:2:\"OK\";s:10:\"\0*\0charset\";N;s:7:\"\0*\0data\";s:489:\"{\"tripTrends\":{\"labels\":[\"Week 1\",\"Week 2\",\"Week 3\",\"Week 4\",\"Week 5\"],\"datasets\":[{\"label\":\"Completed Trips\",\"data\":[0,28,0,0,0],\"borderColor\":\"#28c76f\",\"backgroundColor\":\"rgba(40, 199, 111, 0.1)\",\"tension\":0.4},{\"label\":\"Active Trips\",\"data\":[0,6,0,0,0],\"borderColor\":\"#ff9f43\",\"backgroundColor\":\"rgba(255, 159, 67, 0.1)\",\"tension\":0.4}]},\"vehicleUtilization\":{\"labels\":[\"Available\",\"In Use\",\"Maintenance\"],\"data\":[1,4,0],\"backgroundColor\":[\"#28c76f\",\"#ff9f43\",\"#ea5455\"]},\"period\":\"30\"}\";s:11:\"\0*\0callback\";N;s:18:\"\0*\0encodingOptions\";i:0;s:8:\"original\";a:3:{s:10:\"tripTrends\";a:2:{s:6:\"labels\";a:5:{i:0;s:6:\"Week 1\";i:1;s:6:\"Week 2\";i:2;s:6:\"Week 3\";i:3;s:6:\"Week 4\";i:4;s:6:\"Week 5\";}s:8:\"datasets\";a:2:{i:0;a:5:{s:5:\"label\";s:15:\"Completed Trips\";s:4:\"data\";a:5:{i:0;i:0;i:1;i:28;i:2;i:0;i:3;i:0;i:4;i:0;}s:11:\"borderColor\";s:7:\"#28c76f\";s:15:\"backgroundColor\";s:23:\"rgba(40, 199, 111, 0.1)\";s:7:\"tension\";d:0.4;}i:1;a:5:{s:5:\"label\";s:12:\"Active Trips\";s:4:\"data\";a:5:{i:0;i:0;i:1;i:6;i:2;i:0;i:3;i:0;i:4;i:0;}s:11:\"borderColor\";s:7:\"#ff9f43\";s:15:\"backgroundColor\";s:23:\"rgba(255, 159, 67, 0.1)\";s:7:\"tension\";d:0.4;}}}s:18:\"vehicleUtilization\";a:3:{s:6:\"labels\";a:3:{i:0;s:9:\"Available\";i:1;s:6:\"In Use\";i:2;s:11:\"Maintenance\";}s:4:\"data\";a:3:{i:0;i:1;i:1;i:4;i:2;i:0;}s:15:\"backgroundColor\";a:3:{i:0;s:7:\"#28c76f\";i:1;s:7:\"#ff9f43\";i:2;s:7:\"#ea5455\";}}s:6:\"period\";s:2:\"30\";}s:9:\"exception\";N;}', 1788116473),
('school_vehicle_management_cache_dashboard_active_trips', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:6:{i:0;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:19;s:10:\"student_id\";i:4;s:10:\"vehicle_id\";i:3;s:8:\"route_id\";i:3;s:6:\"status\";s:7:\"pending\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";N;}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:19;s:10:\"student_id\";i:4;s:10:\"vehicle_id\";i:3;s:8:\"route_id\";i:3;s:6:\"status\";s:7:\"pending\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";O:18:\"App\\Models\\Student\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:4;s:4:\"name\";s:13:\"Fatima Sheikh\";s:5:\"class\";s:7:\"Grade 2\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:4;s:4:\"name\";s:13:\"Fatima Sheikh\";s:5:\"class\";s:7:\"Grade 2\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"roll_number\";i:2;s:5:\"class\";i:3;s:9:\"parent_id\";i:4;s:9:\"school_id\";i:5;s:8:\"latitude\";i:6;s:9:\"longitude\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:7:\"vehicle\";O:18:\"App\\Models\\Vehicle\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"vehicles\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:3;s:12:\"number_plate\";s:12:\"KHI-2024-003\";s:5:\"model\";s:12:\"Suzuki Carry\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:3;s:12:\"number_plate\";s:12:\"KHI-2024-003\";s:5:\"model\";s:12:\"Suzuki Carry\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:12:\"number_plate\";i:1;s:5:\"model\";i:2;s:4:\"type\";i:3;s:9:\"driver_id\";i:4;s:9:\"school_id\";i:5;s:12:\"is_available\";i:6;s:6:\"status\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:5:\"route\";O:16:\"App\\Models\\Route\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"routes\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:3;s:4:\"name\";s:35:\"Route C - North Nazimabad to School\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:3;s:4:\"name\";s:35:\"Route C - North Nazimabad to School\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:9:\"school_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:20;s:10:\"student_id\";i:3;s:10:\"vehicle_id\";i:4;s:8:\"route_id\";i:1;s:6:\"status\";s:7:\"pending\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";N;}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:20;s:10:\"student_id\";i:3;s:10:\"vehicle_id\";i:4;s:8:\"route_id\";i:1;s:6:\"status\";s:7:\"pending\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";O:18:\"App\\Models\\Student\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:3;s:4:\"name\";s:10:\"Hassan Ali\";s:5:\"class\";s:7:\"Grade 2\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:3;s:4:\"name\";s:10:\"Hassan Ali\";s:5:\"class\";s:7:\"Grade 2\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"roll_number\";i:2;s:5:\"class\";i:3;s:9:\"parent_id\";i:4;s:9:\"school_id\";i:5;s:8:\"latitude\";i:6;s:9:\"longitude\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:7:\"vehicle\";O:18:\"App\\Models\\Vehicle\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"vehicles\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:4;s:12:\"number_plate\";s:12:\"KHI-2024-004\";s:5:\"model\";s:14:\"Toyota Coaster\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:4;s:12:\"number_plate\";s:12:\"KHI-2024-004\";s:5:\"model\";s:14:\"Toyota Coaster\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:12:\"number_plate\";i:1;s:5:\"model\";i:2;s:4:\"type\";i:3;s:9:\"driver_id\";i:4;s:9:\"school_id\";i:5;s:12:\"is_available\";i:6;s:6:\"status\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:5:\"route\";O:16:\"App\\Models\\Route\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"routes\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:1;s:4:\"name\";s:27:\"Route A - Gulshan to School\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:1;s:4:\"name\";s:27:\"Route A - Gulshan to School\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:9:\"school_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:21;s:10:\"student_id\";i:7;s:10:\"vehicle_id\";i:5;s:8:\"route_id\";i:3;s:6:\"status\";s:7:\"pending\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";N;}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:21;s:10:\"student_id\";i:7;s:10:\"vehicle_id\";i:5;s:8:\"route_id\";i:3;s:6:\"status\";s:7:\"pending\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";O:18:\"App\\Models\\Student\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:7;s:4:\"name\";s:8:\"Omar Ali\";s:5:\"class\";s:7:\"Grade 4\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:7;s:4:\"name\";s:8:\"Omar Ali\";s:5:\"class\";s:7:\"Grade 4\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"roll_number\";i:2;s:5:\"class\";i:3;s:9:\"parent_id\";i:4;s:9:\"school_id\";i:5;s:8:\"latitude\";i:6;s:9:\"longitude\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:7:\"vehicle\";O:18:\"App\\Models\\Vehicle\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"vehicles\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:5;s:12:\"number_plate\";s:12:\"KHI-2024-005\";s:5:\"model\";s:10:\"Honda City\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:5;s:12:\"number_plate\";s:12:\"KHI-2024-005\";s:5:\"model\";s:10:\"Honda City\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:12:\"number_plate\";i:1;s:5:\"model\";i:2;s:4:\"type\";i:3;s:9:\"driver_id\";i:4;s:9:\"school_id\";i:5;s:12:\"is_available\";i:6;s:6:\"status\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:5:\"route\";r:145;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:23;s:10:\"student_id\";i:9;s:10:\"vehicle_id\";i:4;s:8:\"route_id\";i:3;s:6:\"status\";s:7:\"pending\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";N;}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:23;s:10:\"student_id\";i:9;s:10:\"vehicle_id\";i:4;s:8:\"route_id\";i:3;s:6:\"status\";s:7:\"pending\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";O:18:\"App\\Models\\Student\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:9;s:4:\"name\";s:12:\"Ibrahim Khan\";s:5:\"class\";s:7:\"Grade 5\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:9;s:4:\"name\";s:12:\"Ibrahim Khan\";s:5:\"class\";s:7:\"Grade 5\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"roll_number\";i:2;s:5:\"class\";i:3;s:9:\"parent_id\";i:4;s:9:\"school_id\";i:5;s:8:\"latitude\";i:6;s:9:\"longitude\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:7:\"vehicle\";r:306;s:5:\"route\";r:145;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:17;s:10:\"student_id\";i:6;s:10:\"vehicle_id\";i:5;s:8:\"route_id\";i:1;s:6:\"status\";s:11:\"in_progress\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";s:19:\"2026-08-07 17:02:42\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:17;s:10:\"student_id\";i:6;s:10:\"vehicle_id\";i:5;s:8:\"route_id\";i:1;s:6:\"status\";s:11:\"in_progress\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";s:19:\"2026-08-07 17:02:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";O:18:\"App\\Models\\Student\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:6;s:4:\"name\";s:10:\"Zara Ahmed\";s:5:\"class\";s:7:\"Grade 3\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:6;s:4:\"name\";s:10:\"Zara Ahmed\";s:5:\"class\";s:7:\"Grade 3\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"roll_number\";i:2;s:5:\"class\";i:3;s:9:\"parent_id\";i:4;s:9:\"school_id\";i:5;s:8:\"latitude\";i:6;s:9:\"longitude\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:7:\"vehicle\";r:515;s:5:\"route\";r:354;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:18;s:10:\"student_id\";i:5;s:10:\"vehicle_id\";i:4;s:8:\"route_id\";i:3;s:6:\"status\";s:11:\"in_progress\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";s:19:\"2026-08-07 17:02:42\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:18;s:10:\"student_id\";i:5;s:10:\"vehicle_id\";i:4;s:8:\"route_id\";i:3;s:6:\"status\";s:11:\"in_progress\";s:10:\"created_at\";s:19:\"2026-08-07 20:02:42\";s:10:\"started_at\";s:19:\"2026-08-07 17:02:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";O:18:\"App\\Models\\Student\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"Usman Khan\";s:5:\"class\";s:7:\"Grade 3\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"Usman Khan\";s:5:\"class\";s:7:\"Grade 3\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"roll_number\";i:2;s:5:\"class\";i:3;s:9:\"parent_id\";i:4;s:9:\"school_id\";i:5;s:8:\"latitude\";i:6;s:9:\"longitude\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:7:\"vehicle\";r:306;s:5:\"route\";r:145;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1788116231),
('school_vehicle_management_cache_dashboard_recent_trips', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:35;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:7:\"arrived\";s:10:\"created_at\";s:19:\"2026-08-10 03:46:12\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:35;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:7:\"arrived\";s:10:\"created_at\";s:19:\"2026-08-10 03:46:12\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";O:18:\"App\\Models\\Student\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Ali Khan\";s:5:\"class\";s:7:\"Grade 1\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Ali Khan\";s:5:\"class\";s:7:\"Grade 1\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"roll_number\";i:2;s:5:\"class\";i:3;s:9:\"parent_id\";i:4;s:9:\"school_id\";i:5;s:8:\"latitude\";i:6;s:9:\"longitude\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:7:\"vehicle\";O:18:\"App\\Models\\Vehicle\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"vehicles\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:1;s:12:\"number_plate\";s:12:\"KHI-2024-001\";s:5:\"model\";s:12:\"Toyota Hiace\";}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:1;s:12:\"number_plate\";s:12:\"KHI-2024-001\";s:5:\"model\";s:12:\"Toyota Hiace\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:12:\"number_plate\";i:1;s:5:\"model\";i:2;s:4:\"type\";i:3;s:9:\"driver_id\";i:4;s:9:\"school_id\";i:5;s:12:\"is_available\";i:6;s:6:\"status\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:5:\"route\";O:16:\"App\\Models\\Route\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"routes\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:1;s:4:\"name\";s:27:\"Route A - Gulshan to School\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:1;s:4:\"name\";s:27:\"Route A - Gulshan to School\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:9:\"school_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:34;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:9:\"completed\";s:10:\"created_at\";s:19:\"2026-08-09 17:28:43\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:34;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:9:\"completed\";s:10:\"created_at\";s:19:\"2026-08-09 17:28:43\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";r:48;s:7:\"vehicle\";r:95;s:5:\"route\";r:143;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:33;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:9:\"completed\";s:10:\"created_at\";s:19:\"2026-08-09 17:05:26\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:33;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:9:\"completed\";s:10:\"created_at\";s:19:\"2026-08-09 17:05:26\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";r:48;s:7:\"vehicle\";r:95;s:5:\"route\";r:143;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:32;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:9:\"completed\";s:10:\"created_at\";s:19:\"2026-08-09 16:50:32\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:32;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:9:\"completed\";s:10:\"created_at\";s:19:\"2026-08-09 16:50:32\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";r:48;s:7:\"vehicle\";r:95;s:5:\"route\";r:143;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:15:\"App\\Models\\Trip\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"trips\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:31;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:9:\"completed\";s:10:\"created_at\";s:19:\"2026-08-07 21:42:17\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:31;s:10:\"student_id\";i:1;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:1;s:6:\"status\";s:9:\"completed\";s:10:\"created_at\";s:19:\"2026-08-07 21:42:17\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:9:{s:10:\"started_at\";s:8:\"datetime\";s:17:\"pickup_started_at\";s:8:\"datetime\";s:10:\"arrived_at\";s:8:\"datetime\";s:10:\"boarded_at\";s:8:\"datetime\";s:8:\"ended_at\";s:8:\"datetime\";s:18:\"notified_pickup_at\";s:8:\"datetime\";s:19:\"notified_arrived_at\";s:8:\"datetime\";s:19:\"notified_boarded_at\";s:8:\"datetime\";s:21:\"notified_completed_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:7:\"student\";r:48;s:7:\"vehicle\";r:95;s:5:\"route\";r:143;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:10:\"vehicle_id\";i:1;s:8:\"route_id\";i:2;s:9:\"driver_id\";i:3;s:10:\"student_id\";i:4;s:9:\"school_id\";i:5;s:6:\"status\";i:6;s:9:\"direction\";i:7;s:10:\"started_at\";i:8;s:17:\"pickup_started_at\";i:9;s:10:\"arrived_at\";i:10;s:10:\"boarded_at\";i:11;s:8:\"ended_at\";i:12;s:18:\"notified_pickup_at\";i:13;s:19:\"notified_arrived_at\";i:14;s:19:\"notified_boarded_at\";i:15;s:21:\"notified_completed_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1788116471),
('school_vehicle_management_cache_dashboard_stats_optimized', 'a:20:{s:14:\"total_students\";i:11;s:15:\"total_guardians\";i:9;s:14:\"total_vehicles\";i:5;s:13:\"total_drivers\";i:7;s:12:\"total_routes\";i:5;s:11:\"total_trips\";i:35;s:12:\"active_trips\";i:6;s:15:\"completed_trips\";i:28;s:18:\"available_vehicles\";i:1;s:15:\"in_use_vehicles\";i:4;s:20:\"maintenance_vehicles\";i:0;s:17:\"avg_trip_duration\";d:1200;s:18:\"on_time_percentage\";i:95;s:13:\"popular_route\";s:27:\"Route A - Gulshan to School\";s:12:\"safety_score\";i:98;s:9:\"incidents\";i:0;s:13:\"student_trend\";a:2:{s:10:\"percentage\";i:100;s:9:\"direction\";s:2:\"up\";}s:13:\"vehicle_trend\";a:2:{s:10:\"percentage\";i:100;s:9:\"direction\";s:2:\"up\";}s:12:\"driver_trend\";a:2:{s:10:\"percentage\";i:100;s:9:\"direction\";s:2:\"up\";}s:10:\"trip_trend\";a:2:{s:10:\"percentage\";i:100;s:9:\"direction\";s:2:\"up\";}}', 1788116471);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(512) NOT NULL,
  `platform` enum('ios','android','web') NOT NULL DEFAULT 'android',
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cnic` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`id`, `user_id`, `cnic`, `address`, `created_at`, `updated_at`) VALUES
(1, 11, '12345-1234567-1', 'Gulshan-e-Iqbal, Karachi', '2026-08-07 15:02:36', '2026-08-07 15:02:36'),
(2, 12, '12345-1234567-2', 'Defence, Karachi', '2026-08-07 15:02:37', '2026-08-07 15:02:37'),
(3, 13, '12345-1234567-3', 'Clifton, Karachi', '2026-08-07 15:02:37', '2026-08-07 15:02:37'),
(4, 14, '12345-1234567-4', 'North Nazimabad, Karachi', '2026-08-07 15:02:38', '2026-08-07 15:02:38'),
(5, 15, '12345-1234567-5', 'Malir, Karachi', '2026-08-07 15:02:39', '2026-08-07 15:02:39'),
(6, 16, '12345-1234567-6', 'Gulberg, Karachi', '2026-08-07 15:02:39', '2026-08-07 15:02:39'),
(7, 17, '12345-1234567-7', 'Korangi, Karachi', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(8, 18, '12345-1234567-8', 'Landhi, Karachi', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(9, 20, '35202-API-0001', 'Test Address', '2026-08-07 15:26:13', '2026-08-07 15:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2025_01_20_000002_optimize_existing_indexes', 1),
(5, '2025_05_05_110116_create_personal_access_tokens_table', 1),
(6, '2025_05_05_110340_create_permission_tables', 1),
(7, '2025_05_05_111107_create_guardians_table', 1),
(8, '2025_05_05_111108_create_students_table', 1),
(9, '2025_05_05_111222_create_vehicles_table', 1),
(10, '2025_05_05_111234_create_routes_table', 1),
(11, '2025_05_05_111246_create_trips_table', 1),
(12, '2025_05_05_111715_create_trip_locations_table', 1),
(13, '2025_09_27_000000_add_phone_to_users_table', 1),
(14, '2025_09_27_000001_add_unique_cnic_to_guardians_table', 1),
(15, '2025_09_27_120000_create_contacts_table', 1),
(16, '2025_09_28_000000_create_jobs_table', 1),
(17, '2025_09_28_000001_create_failed_jobs_table', 1),
(18, '2025_09_28_120000_add_standard_columns_to_students_table', 1),
(19, '2025_10_05_145808_add_location_to_students_table', 1),
(20, '2025_10_18_140000_create_schools_table', 1),
(21, '2025_10_18_141000_add_school_id_to_students_table', 1),
(22, '2025_10_18_142000_add_school_id_to_vehicles_table', 1),
(23, '2025_10_18_143000_add_school_id_to_routes_table', 1),
(24, '2025_10_18_144000_add_school_id_to_trips_table', 1),
(25, '2025_10_18_150000_make_driver_id_nullable_in_vehicles_table', 1),
(26, '2025_10_19_084009_add_availability_status_to_vehicles_table', 1),
(27, '2025_10_19_090000_add_performance_indexes', 1),
(28, '2026_08_07_000001_add_schedule_fields_to_schools_table', 1),
(29, '2026_08_07_000002_add_tracking_events_to_trips_table', 1),
(30, '2026_08_07_000003_create_device_tokens_table', 1),
(31, '2026_08_07_000004_add_gps_quality_to_trip_locations_table', 1),
(32, '2026_08_08_000001_widen_device_tokens_token_column', 2),
(33, '2026_08_10_000001_add_notified_completed_at_to_trips_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 19),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 14),
(5, 'App\\Models\\User', 15),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 20);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 11, 'flutter-app', '4df579e2c19a955c25878ec1060af527d48cf0bbc0c626ea66cf86334bf0fa37', '[\"*\"]', '2026-08-07 15:37:37', NULL, '2026-08-07 15:35:46', '2026-08-07 15:37:37'),
(4, 'App\\Models\\User', 6, 'flutter-app', '9bf6820f71c5cac27f72e444ee3f6986dcc2f4dea93294a41f018b9a9912f95e', '[\"*\"]', '2026-08-07 15:39:35', NULL, '2026-08-07 15:38:31', '2026-08-07 15:39:35'),
(7, 'App\\Models\\User', 6, 'flutter-app', 'a5f41fe47c54d658c33f766e8a2089d21dc1ae158f8ef29be43d5e831aae8f60', '[\"*\"]', '2026-08-07 15:47:54', NULL, '2026-08-07 15:47:16', '2026-08-07 15:47:54'),
(8, 'App\\Models\\User', 11, 'flutter-app', 'de6fcfc4c345ef44476e3386d7c3b5c5f21b36b88f17072b8710448ee8ecfe75', '[\"*\"]', '2026-08-07 15:47:29', NULL, '2026-08-07 15:47:26', '2026-08-07 15:47:29'),
(11, 'App\\Models\\User', 6, 'flutter-app', 'c18584b0b61e53112284aaa4f9fd80203d7585c54abd61a326b4b1ab20c5b7a8', '[\"*\"]', '2026-08-07 16:07:42', NULL, '2026-08-07 15:58:20', '2026-08-07 16:07:42'),
(12, 'App\\Models\\User', 11, 'flutter-app', '845cc6965b8def4d01f9deb602ff99dd3390ec8946cc58786b233214d546e689', '[\"*\"]', '2026-08-07 16:12:27', NULL, '2026-08-07 15:58:28', '2026-08-07 16:12:27'),
(13, 'App\\Models\\User', 6, 'flutter-app', 'ba9e305be57bf99533f851c63e257f1621e940227778067c45afa7c98de93ac5', '[\"*\"]', '2026-08-07 16:18:15', NULL, '2026-08-07 16:17:07', '2026-08-07 16:18:15'),
(14, 'App\\Models\\User', 11, 'flutter-app', '16cb9bc2e073899725bfe342640ce0bd789bca2c6baa23e248c6c8e0a2d90e30', '[\"*\"]', '2026-08-07 16:22:48', NULL, '2026-08-07 16:17:14', '2026-08-07 16:22:48'),
(15, 'App\\Models\\User', 6, 'flutter-app', '5b081424146d91775093cc6d9ad8f07c9562d5a1834be7a894573259fb589466', '[\"*\"]', '2026-08-07 16:25:03', NULL, '2026-08-07 16:24:25', '2026-08-07 16:25:03'),
(16, 'App\\Models\\User', 11, 'flutter-app', 'caad9ba31c5af88433dfafa384b1406ccde79597ddad220828fb08c128e56db6', '[\"*\"]', '2026-08-07 16:30:58', NULL, '2026-08-07 16:24:29', '2026-08-07 16:30:58'),
(17, 'App\\Models\\User', 6, 'flutter-app', '6186ccf537478e8d0c7ee2dd034a7227daadac9c2ad71259f84370910c9e49b6', '[\"*\"]', '2026-08-07 16:35:35', NULL, '2026-08-07 16:33:49', '2026-08-07 16:35:35'),
(18, 'App\\Models\\User', 11, 'flutter-app', '09cb06e415436b2ad2539ea51d19fab12817902e69f9be1eb62c6032e6f837ce', '[\"*\"]', '2026-08-07 16:39:21', NULL, '2026-08-07 16:33:53', '2026-08-07 16:39:21'),
(19, 'App\\Models\\User', 6, 'flutter-app', '056bca0b9a3fcf6893b88808699bca3a7fe8e1e569b5cd1335aee259cd29a9c2', '[\"*\"]', '2026-08-07 16:40:36', NULL, '2026-08-07 16:40:33', '2026-08-07 16:40:36'),
(20, 'App\\Models\\User', 11, 'flutter-app', 'fd4a83ff638e0017f7ab6287b8217dd64723ada836e7b6599460353a1714098a', '[\"*\"]', '2026-08-07 16:44:01', NULL, '2026-08-07 16:40:40', '2026-08-07 16:44:01'),
(21, 'App\\Models\\User', 6, 'flutter-app', 'eb0904a5e56eb33cb79bc191034f07c667620b17b9ff9e6a1ac05ac24849cbe4', '[\"*\"]', '2026-08-08 10:30:21', NULL, '2026-08-07 16:45:22', '2026-08-08 10:30:21'),
(22, 'App\\Models\\User', 11, 'flutter-app', 'b3c8d3bd907b7595c07d4a9db0b05c0f670b2ed8e848b092949215b5615cca5f', '[\"*\"]', '2026-08-08 10:29:47', NULL, '2026-08-07 16:45:30', '2026-08-08 10:29:47'),
(23, 'App\\Models\\User', 6, 'flutter-app', '4cfc6113ee1d17dd15b9539c76145c519c239a049a30452cfb6ebe5db6447fc0', '[\"*\"]', '2026-08-09 11:57:07', NULL, '2026-08-09 11:57:05', '2026-08-09 11:57:07'),
(24, 'App\\Models\\User', 11, 'flutter-app', '74e4e0b35f6d9ba9beb0f7967211d78c324bd04bb309312df89248aa48d734ef', '[\"*\"]', '2026-08-09 12:12:32', NULL, '2026-08-09 11:57:37', '2026-08-09 12:12:32'),
(25, 'App\\Models\\User', 6, 'flutter-app', '12fe4933ca6219c854cc00f88f7a6873b78ab0d20840297d00ca2463df3bbf72', '[\"*\"]', '2026-08-09 12:23:00', NULL, '2026-08-09 12:21:00', '2026-08-09 12:23:00'),
(26, 'App\\Models\\User', 11, 'flutter-app', '16988799193eeef42234654f45fdf5e9eccc96e4af6424c94934238449ade8db', '[\"*\"]', '2026-08-09 12:27:56', NULL, '2026-08-09 12:21:06', '2026-08-09 12:27:56'),
(27, 'App\\Models\\User', 6, 'flutter-app', '270dad441d82f94ec0ee23a5abdb1a6a9aec54d675a7092eb1f4c93ef73fcb99', '[\"*\"]', '2026-08-09 12:28:02', NULL, '2026-08-09 12:28:00', '2026-08-09 12:28:02'),
(28, 'App\\Models\\User', 6, 'flutter-app', '86afda5f1a411ddaeeaf8d3a0cd8d9cd7f5f809b16f88aac6ea78e2504fb325c', '[\"*\"]', '2026-08-09 22:00:28', NULL, '2026-08-09 12:31:40', '2026-08-09 22:00:28'),
(29, 'App\\Models\\User', 11, 'flutter-app', '4063746c1509f39f32fea956eafff5e7588432926fdd11cdf700e219f0227697', '[\"*\"]', '2026-08-09 22:00:17', NULL, '2026-08-09 12:31:44', '2026-08-09 22:00:17'),
(30, 'App\\Models\\User', 6, 'flutter-app', '4fd5d44e48ef61577b6069e861f5bd3dd0f949d71a4931dc1b28771517a0cfc8', '[\"*\"]', '2026-08-09 23:03:53', NULL, '2026-08-09 23:01:02', '2026-08-09 23:03:53'),
(31, 'App\\Models\\User', 11, 'flutter-app', 'd06ceb9e50e589fdc088c42b2e102db783995ed3232f7ece73e4ff1990ce1ab1', '[\"*\"]', '2026-08-09 23:09:19', NULL, '2026-08-09 23:01:09', '2026-08-09 23:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-08-07 15:02:30', '2026-08-07 15:02:30'),
(2, 'student', 'web', '2026-08-07 15:02:30', '2026-08-07 15:02:30'),
(3, 'driver', 'web', '2026-08-07 15:02:30', '2026-08-07 15:02:30'),
(4, 'parent', 'web', '2026-08-07 15:02:30', '2026-08-07 15:02:30'),
(5, 'guardian', 'web', '2026-08-07 15:02:33', '2026-08-07 15:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `description`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Route A - Gulshan to School', 'Covers Gulshan-e-Iqbal, Defence, and surrounding areas', 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(2, 'Route B - Clifton to School', 'Covers Clifton, DHA, and nearby localities', 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(3, 'Route C - North Nazimabad to School', 'Covers North Nazimabad, Nazimabad, and adjacent areas', 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(4, 'Route D - Malir to School', 'Covers Malir, Korangi, and surrounding areas', 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(5, 'Route E - Gulberg to School', 'Covers Gulberg, Landhi, and nearby areas', 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'Pakistan',
  `postal_code` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `principal_name` varchar(255) DEFAULT NULL,
  `principal_email` varchar(255) DEFAULT NULL,
  `principal_phone` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `timezone` varchar(64) NOT NULL DEFAULT 'Asia/Karachi',
  `pickup_lead_minutes` smallint(5) UNSIGNED NOT NULL DEFAULT 45,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `email`, `phone`, `address`, `city`, `state`, `country`, `postal_code`, `latitude`, `longitude`, `website`, `description`, `principal_name`, `principal_email`, `principal_phone`, `logo`, `is_active`, `start_time`, `end_time`, `timezone`, `pickup_lead_minutes`, `created_at`, `updated_at`) VALUES
(1, 'Demo School', 'demo.school@example.com', '03001234567', 'Gulberg', 'Lahore', 'Punjab', 'Pakistan', NULL, 31.54970000, 74.34360000, NULL, NULL, NULL, NULL, NULL, NULL, 1, '08:00:00', '14:00:00', 'Asia/Karachi', 45, '2026-08-07 16:20:24', '2026-08-07 16:20:24'),
(2, 'abc', 'muhammadawaistariq06@gmail.com', '03321407167', 'House no 11 Street No 40 Pakki Thakki Samanabad Lahore', 'Lahore Samanabad', 'pakistan', 'Pakistan', '54000', 72.33330000, 43.33330000, 'https://www.kohinoortouch.com/products/watch-with-jewelry', NULL, NULL, NULL, NULL, NULL, 1, '08:00:00', '14:00:00', 'Asia/Karachi', 45, '2026-08-13 07:45:18', '2026-08-13 07:45:18');

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
('8fSVR0a89qifLP2nH2G7ZTYlXWXR3KKyeFtlUpBw', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlJ1Vm8xb2VtWU14bnhYTFBPTlY3TDI2ZzNiZlh5aUFqbjVHUkJzNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zY2hvb2wvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1788039278),
('cnm1pDOEgv8zFRmylAspK7bI2es7MTQjHbxXiFjK', NULL, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVhsNWlONG8zMGVMeXc3SVVGZlpHZG5ndTN1ZGJnN3VhYmpFaFNzdyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo3MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2dlb2NvZGUvc2VhcmNoP3E9RWR1Y2F0b3IlMjBTY2hvb2wlMjBMYWhvcmUiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo3MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2dlb2NvZGUvc2VhcmNoP3E9RWR1Y2F0b3IlMjBTY2hvb2wlMjBMYWhvcmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788116730),
('o9dr9RdPRlT173t5JHUXMmFlhigaE8wKkHzZUskr', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY0FJejZTS3ZhTTd4bjN2aDBpY3laMUVZZWFhdHhwMjVJSENCUnFuTCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3NjaG9vbC9jcmVhdGUiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3NjaG9vbC9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1788117531),
('RdZ9WJHyuOwwHbAKZhsr8wkVaWmf3YXkG5WUBP4U', NULL, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQXRPcXNMaERBYXQ3TTdwNzQ2NllibkxpclpKdEVRbFNRbk51NGF2eCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo3MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2dlb2NvZGUvc2VhcmNoP3E9RWR1Y2F0b3IlMjBTY2hvb2wlMjBMYWhvcmUiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo3MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2dlb2NvZGUvc2VhcmNoP3E9RWR1Y2F0b3IlMjBTY2hvb2wlMjBMYWhvcmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788116730);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `roll_number`, `class`, `parent_id`, `school_id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Ali Khan', 'ST001', 'Grade 1', 1, 1, 31.5204000, 74.3587000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(2, 'Aisha Ahmed', 'ST002', 'Grade 1', 2, 1, 31.5210000, 74.3595000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(3, 'Hassan Ali', 'ST003', 'Grade 2', 3, 1, 31.5215000, 74.3600000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(4, 'Fatima Sheikh', 'ST004', 'Grade 2', 4, 1, 31.5220000, 74.3605000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(5, 'Usman Khan', 'ST005', 'Grade 3', 5, 1, 31.5225000, 74.3610000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(6, 'Zara Ahmed', 'ST006', 'Grade 3', 6, 1, 31.5230000, 74.3615000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(7, 'Omar Ali', 'ST007', 'Grade 4', 7, 1, 31.5235000, 74.3620000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(8, 'Layla Sheikh', 'ST008', 'Grade 4', 8, 1, 31.5240000, 74.3625000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(9, 'Ibrahim Khan', 'ST009', 'Grade 5', 1, 1, 31.5245000, 74.3630000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(10, 'Amina Ahmed', 'ST010', 'Grade 5', 2, 1, 31.5250000, 74.3635000, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(11, 'API Student', 'API-ST-001', 'Grade 1', 9, 1, 31.5204000, 74.3587000, '2026-08-07 15:26:13', '2026-08-07 16:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','en_route','arrived','in_progress','completed') NOT NULL DEFAULT 'pending',
  `direction` enum('to_school','from_school') NOT NULL DEFAULT 'to_school',
  `started_at` timestamp NULL DEFAULT NULL,
  `pickup_started_at` timestamp NULL DEFAULT NULL,
  `arrived_at` timestamp NULL DEFAULT NULL,
  `boarded_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `notified_pickup_at` timestamp NULL DEFAULT NULL,
  `notified_arrived_at` timestamp NULL DEFAULT NULL,
  `notified_boarded_at` timestamp NULL DEFAULT NULL,
  `notified_completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `vehicle_id`, `route_id`, `driver_id`, `student_id`, `school_id`, `status`, `direction`, `started_at`, `pickup_started_at`, `arrived_at`, `boarded_at`, `ended_at`, `notified_pickup_at`, `notified_arrived_at`, `notified_boarded_at`, `notified_completed_at`, `created_at`, `updated_at`) VALUES
(1, 3, 5, 8, 9, 1, 'completed', 'to_school', '2026-08-05 01:45:00', NULL, NULL, NULL, '2026-07-16 08:47:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(2, 4, 3, 9, 5, 1, 'completed', 'to_school', '2026-07-08 00:49:00', NULL, NULL, NULL, '2026-07-31 10:09:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(3, 3, 5, 8, 3, 1, 'completed', 'to_school', '2026-07-28 01:17:00', NULL, NULL, NULL, '2026-08-04 08:54:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(4, 2, 4, 7, 9, 1, 'completed', 'to_school', '2026-07-31 01:28:00', NULL, NULL, NULL, '2026-07-22 09:22:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(5, 2, 3, 7, 3, 1, 'completed', 'to_school', '2026-07-09 02:13:00', NULL, NULL, NULL, '2026-07-24 09:43:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(6, 2, 4, 7, 9, 1, 'completed', 'to_school', '2026-07-13 01:25:00', NULL, NULL, NULL, '2026-07-23 10:25:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(7, 5, 1, 10, 7, 1, 'completed', 'to_school', '2026-08-06 01:44:00', NULL, NULL, NULL, '2026-07-15 08:57:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(8, 3, 2, 8, 9, 1, 'completed', 'to_school', '2026-07-16 01:53:00', NULL, NULL, NULL, '2026-07-12 09:45:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(9, 2, 1, 7, 1, 1, 'completed', 'to_school', '2026-07-28 02:05:00', NULL, NULL, NULL, '2026-07-25 09:19:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(10, 4, 5, 9, 10, 1, 'completed', 'to_school', '2026-07-15 01:14:00', NULL, NULL, NULL, '2026-07-24 09:54:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(11, 2, 3, 7, 10, 1, 'completed', 'to_school', '2026-07-11 01:51:00', NULL, NULL, NULL, '2026-07-11 10:10:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(12, 3, 1, 8, 6, 1, 'completed', 'to_school', '2026-07-11 01:48:00', NULL, NULL, NULL, '2026-07-27 09:53:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(13, 1, 5, 6, 4, 1, 'completed', 'to_school', '2026-07-30 02:04:00', NULL, NULL, NULL, '2026-07-22 09:13:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(14, 1, 2, 6, 8, 1, 'completed', 'to_school', '2026-07-29 01:54:00', NULL, NULL, NULL, '2026-07-21 09:05:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(15, 1, 3, 6, 10, 1, 'completed', 'to_school', '2026-07-29 02:22:00', NULL, NULL, NULL, '2026-08-02 09:47:00', NULL, NULL, NULL, NULL, '2026-08-07 15:02:41', '2026-08-07 16:20:24'),
(16, 1, 2, 6, 3, 1, 'completed', 'to_school', '2026-08-07 13:02:42', NULL, NULL, NULL, '2026-08-07 15:28:36', NULL, NULL, NULL, NULL, '2026-08-07 15:02:42', '2026-08-07 16:20:24'),
(17, 5, 1, 10, 6, 1, 'in_progress', 'to_school', '2026-08-07 12:02:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-07 15:02:42', '2026-08-07 16:20:24'),
(18, 4, 3, 9, 5, 1, 'in_progress', 'to_school', '2026-08-07 12:02:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-07 15:02:42', '2026-08-07 16:20:24'),
(19, 3, 3, 8, 4, 1, 'pending', 'to_school', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-07 15:02:42', '2026-08-07 16:20:24'),
(20, 4, 1, 9, 3, 1, 'pending', 'to_school', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-07 15:02:42', '2026-08-07 16:20:24'),
(21, 5, 3, 10, 7, 1, 'pending', 'to_school', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-07 15:02:42', '2026-08-07 16:20:24'),
(22, 1, 3, 6, 5, 1, 'completed', 'to_school', NULL, NULL, NULL, NULL, '2026-08-07 15:28:36', NULL, NULL, NULL, NULL, '2026-08-07 15:02:42', '2026-08-07 16:20:24'),
(23, 4, 3, 9, 9, 1, 'pending', 'to_school', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-07 15:02:42', '2026-08-07 16:20:24'),
(24, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, '2026-08-07 15:30:21', '2026-08-07 15:30:40', NULL, '2026-08-07 15:36:53', '2026-08-07 15:30:21', '2026-08-07 15:30:40', NULL, NULL, '2026-08-07 15:28:36', '2026-08-07 16:20:24'),
(25, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, '2026-08-07 15:39:35', NULL, NULL, '2026-08-07 15:40:39', '2026-08-07 15:39:35', NULL, NULL, NULL, '2026-08-07 15:36:53', '2026-08-07 16:20:24'),
(26, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, '2026-08-07 15:47:42', NULL, NULL, '2026-08-07 15:50:01', '2026-08-07 15:47:42', NULL, NULL, NULL, '2026-08-07 15:40:39', '2026-08-07 16:20:24'),
(27, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, '2026-08-07 15:58:42', '2026-08-07 15:59:23', NULL, '2026-08-07 16:21:13', '2026-08-07 15:58:42', '2026-08-07 15:59:23', NULL, NULL, '2026-08-07 15:50:01', '2026-08-07 16:21:13'),
(28, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, '2026-08-07 16:24:50', NULL, NULL, '2026-08-07 16:28:33', '2026-08-07 16:24:51', NULL, NULL, NULL, '2026-08-07 16:21:13', '2026-08-07 16:28:33'),
(29, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, '2026-08-07 16:34:14', '2026-08-07 16:35:13', NULL, '2026-08-07 16:41:19', '2026-08-07 16:34:14', '2026-08-07 16:35:14', NULL, NULL, '2026-08-07 16:28:33', '2026-08-07 16:41:19'),
(30, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, NULL, NULL, NULL, '2026-08-07 16:42:17', NULL, NULL, NULL, NULL, '2026-08-07 16:41:19', '2026-08-07 16:42:17'),
(31, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, '2026-08-07 16:45:46', NULL, NULL, '2026-08-09 11:50:32', '2026-08-07 16:45:46', NULL, NULL, NULL, '2026-08-07 16:42:17', '2026-08-09 11:50:32'),
(32, 1, 1, 6, 1, 1, 'completed', 'to_school', NULL, NULL, NULL, NULL, '2026-08-09 12:05:26', NULL, NULL, NULL, NULL, '2026-08-09 11:50:32', '2026-08-09 12:05:26'),
(33, 1, 1, 6, 1, 1, 'completed', 'to_school', '2026-08-09 12:22:29', '2026-08-09 12:21:30', '2026-08-09 12:22:06', '2026-08-09 12:22:29', '2026-08-09 12:23:00', '2026-08-09 12:21:30', '2026-08-09 12:22:06', '2026-08-09 12:22:29', NULL, '2026-08-09 12:05:26', '2026-08-09 12:23:00'),
(34, 1, 1, 6, 1, 1, 'completed', 'to_school', '2026-08-09 12:32:20', '2026-08-09 12:31:53', '2026-08-09 12:32:12', '2026-08-09 12:32:20', '2026-08-09 12:32:27', '2026-08-09 12:31:54', '2026-08-09 12:32:12', '2026-08-09 12:32:20', '2026-08-09 12:32:27', '2026-08-09 12:28:43', '2026-08-09 12:32:27'),
(35, 1, 1, 6, 1, 1, 'arrived', 'to_school', NULL, '2026-08-09 23:02:25', '2026-08-09 23:03:31', NULL, NULL, '2026-08-09 23:02:25', '2026-08-09 23:03:31', NULL, NULL, '2026-08-09 22:46:12', '2026-08-09 23:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `trip_locations`
--

CREATE TABLE `trip_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `accuracy` decimal(8,2) DEFAULT NULL,
  `heading` decimal(6,2) DEFAULT NULL,
  `speed` decimal(8,2) DEFAULT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_locations`
--

INSERT INTO `trip_locations` (`id`, `trip_id`, `latitude`, `longitude`, `accuracy`, `heading`, `speed`, `recorded_at`, `created_at`, `updated_at`) VALUES
(1, 1, 31.5207000, 74.3489000, NULL, NULL, NULL, '2026-08-05 01:45:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(2, 1, 31.5108000, 74.3601000, NULL, NULL, NULL, '2026-08-05 01:55:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(3, 1, 31.5291000, 74.3600000, NULL, NULL, NULL, '2026-08-05 02:05:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(4, 1, 31.5247000, 74.3613000, NULL, NULL, NULL, '2026-08-05 02:15:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(5, 1, 31.5121000, 74.3655000, NULL, NULL, NULL, '2026-08-05 02:25:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(6, 1, 31.5213000, 74.3562000, NULL, NULL, NULL, '2026-08-05 02:35:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(7, 1, 31.5230000, 74.3500000, NULL, NULL, NULL, '2026-08-05 02:45:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(8, 1, 31.5264000, 74.3657000, NULL, NULL, NULL, '2026-08-05 02:55:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(9, 1, 31.5273000, 74.3614000, NULL, NULL, NULL, '2026-08-05 03:05:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(10, 2, 31.5185000, 74.3618000, NULL, NULL, NULL, '2026-07-08 00:49:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(11, 2, 31.5161000, 74.3528000, NULL, NULL, NULL, '2026-07-08 00:59:00', '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(12, 2, 31.5146000, 74.3529000, NULL, NULL, NULL, '2026-07-08 01:09:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(13, 2, 31.5136000, 74.3663000, NULL, NULL, NULL, '2026-07-08 01:19:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(14, 2, 31.5117000, 74.3505000, NULL, NULL, NULL, '2026-07-08 01:29:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(15, 2, 31.5276000, 74.3590000, NULL, NULL, NULL, '2026-07-08 01:39:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(16, 2, 31.5290000, 74.3637000, NULL, NULL, NULL, '2026-07-08 01:49:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(17, 2, 31.5195000, 74.3550000, NULL, NULL, NULL, '2026-07-08 01:59:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(18, 2, 31.5131000, 74.3627000, NULL, NULL, NULL, '2026-07-08 02:09:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(19, 3, 31.5263000, 74.3493000, NULL, NULL, NULL, '2026-07-28 01:17:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(20, 3, 31.5143000, 74.3592000, NULL, NULL, NULL, '2026-07-28 01:27:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(21, 3, 31.5138000, 74.3600000, NULL, NULL, NULL, '2026-07-28 01:37:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(22, 3, 31.5276000, 74.3645000, NULL, NULL, NULL, '2026-07-28 01:47:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(23, 3, 31.5277000, 74.3668000, NULL, NULL, NULL, '2026-07-28 01:57:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(24, 3, 31.5123000, 74.3527000, NULL, NULL, NULL, '2026-07-28 02:07:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(25, 3, 31.5144000, 74.3590000, NULL, NULL, NULL, '2026-07-28 02:17:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(26, 3, 31.5137000, 74.3602000, NULL, NULL, NULL, '2026-07-28 02:27:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(27, 3, 31.5245000, 74.3554000, NULL, NULL, NULL, '2026-07-28 02:37:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(28, 4, 31.5110000, 74.3564000, NULL, NULL, NULL, '2026-07-31 01:28:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(29, 4, 31.5172000, 74.3556000, NULL, NULL, NULL, '2026-07-31 01:38:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(30, 4, 31.5184000, 74.3549000, NULL, NULL, NULL, '2026-07-31 01:48:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(31, 4, 31.5220000, 74.3520000, NULL, NULL, NULL, '2026-07-31 01:58:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(32, 4, 31.5225000, 74.3588000, NULL, NULL, NULL, '2026-07-31 02:08:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(33, 4, 31.5272000, 74.3624000, NULL, NULL, NULL, '2026-07-31 02:18:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(34, 4, 31.5187000, 74.3625000, NULL, NULL, NULL, '2026-07-31 02:28:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(35, 4, 31.5295000, 74.3535000, NULL, NULL, NULL, '2026-07-31 02:38:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(36, 4, 31.5141000, 74.3575000, NULL, NULL, NULL, '2026-07-31 02:48:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(37, 5, 31.5143000, 74.3505000, NULL, NULL, NULL, '2026-07-09 02:13:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(38, 5, 31.5264000, 74.3517000, NULL, NULL, NULL, '2026-07-09 02:23:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(39, 5, 31.5171000, 74.3579000, NULL, NULL, NULL, '2026-07-09 02:33:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(40, 5, 31.5280000, 74.3551000, NULL, NULL, NULL, '2026-07-09 02:43:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(41, 5, 31.5242000, 74.3660000, NULL, NULL, NULL, '2026-07-09 02:53:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(42, 5, 31.5299000, 74.3576000, NULL, NULL, NULL, '2026-07-09 03:03:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(43, 6, 31.5164000, 74.3572000, NULL, NULL, NULL, '2026-07-13 01:25:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(44, 6, 31.5250000, 74.3533000, NULL, NULL, NULL, '2026-07-13 01:35:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(45, 6, 31.5228000, 74.3597000, NULL, NULL, NULL, '2026-07-13 01:45:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(46, 6, 31.5115000, 74.3503000, NULL, NULL, NULL, '2026-07-13 01:55:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(47, 6, 31.5161000, 74.3543000, NULL, NULL, NULL, '2026-07-13 02:05:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(48, 6, 31.5237000, 74.3509000, NULL, NULL, NULL, '2026-07-13 02:15:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(49, 6, 31.5138000, 74.3542000, NULL, NULL, NULL, '2026-07-13 02:25:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(50, 7, 31.5216000, 74.3497000, NULL, NULL, NULL, '2026-08-06 01:44:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(51, 7, 31.5234000, 74.3554000, NULL, NULL, NULL, '2026-08-06 01:54:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(52, 7, 31.5139000, 74.3612000, NULL, NULL, NULL, '2026-08-06 02:04:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(53, 7, 31.5293000, 74.3559000, NULL, NULL, NULL, '2026-08-06 02:14:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(54, 7, 31.5114000, 74.3488000, NULL, NULL, NULL, '2026-08-06 02:24:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(55, 7, 31.5197000, 74.3602000, NULL, NULL, NULL, '2026-08-06 02:34:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(56, 7, 31.5154000, 74.3552000, NULL, NULL, NULL, '2026-08-06 02:44:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(57, 7, 31.5248000, 74.3651000, NULL, NULL, NULL, '2026-08-06 02:54:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(58, 7, 31.5201000, 74.3509000, NULL, NULL, NULL, '2026-08-06 03:04:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(59, 7, 31.5200000, 74.3683000, NULL, NULL, NULL, '2026-08-06 03:14:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(60, 8, 31.5239000, 74.3640000, NULL, NULL, NULL, '2026-07-16 01:53:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(61, 8, 31.5275000, 74.3520000, NULL, NULL, NULL, '2026-07-16 02:03:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(62, 8, 31.5127000, 74.3595000, NULL, NULL, NULL, '2026-07-16 02:13:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(63, 8, 31.5251000, 74.3613000, NULL, NULL, NULL, '2026-07-16 02:23:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(64, 8, 31.5258000, 74.3538000, NULL, NULL, NULL, '2026-07-16 02:33:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(65, 8, 31.5178000, 74.3685000, NULL, NULL, NULL, '2026-07-16 02:43:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(66, 9, 31.5265000, 74.3653000, NULL, NULL, NULL, '2026-07-28 02:05:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(67, 9, 31.5205000, 74.3655000, NULL, NULL, NULL, '2026-07-28 02:15:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(68, 9, 31.5173000, 74.3570000, NULL, NULL, NULL, '2026-07-28 02:25:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(69, 9, 31.5250000, 74.3507000, NULL, NULL, NULL, '2026-07-28 02:35:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(70, 9, 31.5122000, 74.3522000, NULL, NULL, NULL, '2026-07-28 02:45:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(71, 9, 31.5242000, 74.3687000, NULL, NULL, NULL, '2026-07-28 02:55:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(72, 9, 31.5256000, 74.3526000, NULL, NULL, NULL, '2026-07-28 03:05:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(73, 9, 31.5221000, 74.3626000, NULL, NULL, NULL, '2026-07-28 03:15:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(74, 9, 31.5278000, 74.3572000, NULL, NULL, NULL, '2026-07-28 03:25:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(75, 9, 31.5194000, 74.3543000, NULL, NULL, NULL, '2026-07-28 03:35:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(76, 10, 31.5230000, 74.3498000, NULL, NULL, NULL, '2026-07-15 01:14:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(77, 10, 31.5212000, 74.3686000, NULL, NULL, NULL, '2026-07-15 01:24:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(78, 10, 31.5219000, 74.3492000, NULL, NULL, NULL, '2026-07-15 01:34:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(79, 10, 31.5298000, 74.3551000, NULL, NULL, NULL, '2026-07-15 01:44:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(80, 10, 31.5129000, 74.3494000, NULL, NULL, NULL, '2026-07-15 01:54:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(81, 10, 31.5276000, 74.3687000, NULL, NULL, NULL, '2026-07-15 02:04:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(82, 10, 31.5199000, 74.3656000, NULL, NULL, NULL, '2026-07-15 02:14:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(83, 10, 31.5180000, 74.3600000, NULL, NULL, NULL, '2026-07-15 02:24:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(84, 10, 31.5289000, 74.3664000, NULL, NULL, NULL, '2026-07-15 02:34:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(85, 10, 31.5267000, 74.3595000, NULL, NULL, NULL, '2026-07-15 02:44:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(86, 11, 31.5289000, 74.3578000, NULL, NULL, NULL, '2026-07-11 01:51:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(87, 11, 31.5138000, 74.3513000, NULL, NULL, NULL, '2026-07-11 02:01:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(88, 11, 31.5278000, 74.3535000, NULL, NULL, NULL, '2026-07-11 02:11:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(89, 11, 31.5225000, 74.3680000, NULL, NULL, NULL, '2026-07-11 02:21:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(90, 11, 31.5294000, 74.3652000, NULL, NULL, NULL, '2026-07-11 02:31:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(91, 11, 31.5110000, 74.3647000, NULL, NULL, NULL, '2026-07-11 02:41:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(92, 11, 31.5138000, 74.3578000, NULL, NULL, NULL, '2026-07-11 02:51:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(93, 12, 31.5111000, 74.3671000, NULL, NULL, NULL, '2026-07-11 01:48:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(94, 12, 31.5167000, 74.3568000, NULL, NULL, NULL, '2026-07-11 01:58:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(95, 12, 31.5166000, 74.3615000, NULL, NULL, NULL, '2026-07-11 02:08:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(96, 12, 31.5206000, 74.3505000, NULL, NULL, NULL, '2026-07-11 02:18:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(97, 12, 31.5104000, 74.3625000, NULL, NULL, NULL, '2026-07-11 02:28:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(98, 12, 31.5210000, 74.3542000, NULL, NULL, NULL, '2026-07-11 02:38:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(99, 12, 31.5196000, 74.3566000, NULL, NULL, NULL, '2026-07-11 02:48:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(100, 12, 31.5259000, 74.3656000, NULL, NULL, NULL, '2026-07-11 02:58:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(101, 13, 31.5270000, 74.3562000, NULL, NULL, NULL, '2026-07-30 02:04:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(102, 13, 31.5134000, 74.3513000, NULL, NULL, NULL, '2026-07-30 02:14:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(103, 13, 31.5172000, 74.3661000, NULL, NULL, NULL, '2026-07-30 02:24:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(104, 13, 31.5125000, 74.3588000, NULL, NULL, NULL, '2026-07-30 02:34:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(105, 13, 31.5285000, 74.3565000, NULL, NULL, NULL, '2026-07-30 02:44:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(106, 13, 31.5267000, 74.3512000, NULL, NULL, NULL, '2026-07-30 02:54:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(107, 13, 31.5123000, 74.3677000, NULL, NULL, NULL, '2026-07-30 03:04:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(108, 13, 31.5188000, 74.3589000, NULL, NULL, NULL, '2026-07-30 03:14:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(109, 14, 31.5248000, 74.3491000, NULL, NULL, NULL, '2026-07-29 01:54:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(110, 14, 31.5119000, 74.3606000, NULL, NULL, NULL, '2026-07-29 02:04:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(111, 14, 31.5247000, 74.3532000, NULL, NULL, NULL, '2026-07-29 02:14:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(112, 14, 31.5154000, 74.3569000, NULL, NULL, NULL, '2026-07-29 02:24:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(113, 14, 31.5109000, 74.3562000, NULL, NULL, NULL, '2026-07-29 02:34:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(114, 14, 31.5251000, 74.3613000, NULL, NULL, NULL, '2026-07-29 02:44:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(115, 14, 31.5119000, 74.3582000, NULL, NULL, NULL, '2026-07-29 02:54:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(116, 14, 31.5219000, 74.3663000, NULL, NULL, NULL, '2026-07-29 03:04:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(117, 14, 31.5221000, 74.3601000, NULL, NULL, NULL, '2026-07-29 03:14:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(118, 14, 31.5182000, 74.3657000, NULL, NULL, NULL, '2026-07-29 03:24:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(119, 15, 31.5266000, 74.3536000, NULL, NULL, NULL, '2026-07-29 02:22:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(120, 15, 31.5304000, 74.3494000, NULL, NULL, NULL, '2026-07-29 02:32:00', '2026-08-07 15:02:41', '2026-08-07 15:02:41'),
(121, 15, 31.5246000, 74.3640000, NULL, NULL, NULL, '2026-07-29 02:42:00', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(122, 15, 31.5206000, 74.3674000, NULL, NULL, NULL, '2026-07-29 02:52:00', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(123, 15, 31.5192000, 74.3559000, NULL, NULL, NULL, '2026-07-29 03:02:00', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(124, 15, 31.5248000, 74.3528000, NULL, NULL, NULL, '2026-07-29 03:12:00', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(125, 15, 31.5302000, 74.3595000, NULL, NULL, NULL, '2026-07-29 03:22:00', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(126, 15, 31.5198000, 74.3613000, NULL, NULL, NULL, '2026-07-29 03:32:00', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(127, 15, 31.5173000, 74.3538000, NULL, NULL, NULL, '2026-07-29 03:42:00', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(128, 15, 31.5258000, 74.3559000, NULL, NULL, NULL, '2026-07-29 03:52:00', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(129, 16, 31.5178000, 74.3609000, NULL, NULL, NULL, '2026-08-07 13:02:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(130, 16, 31.5297000, 74.3681000, NULL, NULL, NULL, '2026-08-07 13:12:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(131, 16, 31.5120000, 74.3604000, NULL, NULL, NULL, '2026-08-07 13:22:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(132, 16, 31.5280000, 74.3525000, NULL, NULL, NULL, '2026-08-07 13:32:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(133, 16, 31.5301000, 74.3541000, NULL, NULL, NULL, '2026-08-07 13:42:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(134, 16, 31.5106000, 74.3513000, NULL, NULL, NULL, '2026-08-07 13:52:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(135, 16, 31.5222000, 74.3650000, NULL, NULL, NULL, '2026-08-07 14:02:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(136, 16, 31.5144000, 74.3601000, NULL, NULL, NULL, '2026-08-07 14:12:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(137, 16, 31.5165000, 74.3628000, NULL, NULL, NULL, '2026-08-07 14:22:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(138, 16, 31.5221000, 74.3498000, NULL, NULL, NULL, '2026-08-07 14:32:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(139, 17, 31.5195000, 74.3687000, NULL, NULL, NULL, '2026-08-07 12:02:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(140, 17, 31.5294000, 74.3512000, NULL, NULL, NULL, '2026-08-07 12:12:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(141, 17, 31.5266000, 74.3591000, NULL, NULL, NULL, '2026-08-07 12:22:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(142, 17, 31.5290000, 74.3564000, NULL, NULL, NULL, '2026-08-07 12:32:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(143, 17, 31.5275000, 74.3493000, NULL, NULL, NULL, '2026-08-07 12:42:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(144, 17, 31.5141000, 74.3612000, NULL, NULL, NULL, '2026-08-07 12:52:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(145, 18, 31.5230000, 74.3541000, NULL, NULL, NULL, '2026-08-07 12:02:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(146, 18, 31.5290000, 74.3661000, NULL, NULL, NULL, '2026-08-07 12:12:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(147, 18, 31.5162000, 74.3529000, NULL, NULL, NULL, '2026-08-07 12:22:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(148, 18, 31.5119000, 74.3596000, NULL, NULL, NULL, '2026-08-07 12:32:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(149, 18, 31.5177000, 74.3629000, NULL, NULL, NULL, '2026-08-07 12:42:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(150, 18, 31.5148000, 74.3489000, NULL, NULL, NULL, '2026-08-07 12:52:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(151, 18, 31.5227000, 74.3524000, NULL, NULL, NULL, '2026-08-07 13:02:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(152, 18, 31.5221000, 74.3591000, NULL, NULL, NULL, '2026-08-07 13:12:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(153, 18, 31.5131000, 74.3658000, NULL, NULL, NULL, '2026-08-07 13:22:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(154, 18, 31.5257000, 74.3522000, NULL, NULL, NULL, '2026-08-07 13:32:42', '2026-08-07 15:02:42', '2026-08-07 15:02:42'),
(155, 26, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 15:47:53', '2026-08-07 15:47:53', '2026-08-07 15:47:53'),
(156, 26, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 15:47:55', '2026-08-07 15:47:55', '2026-08-07 15:47:55'),
(157, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 15:58:58', '2026-08-07 15:58:58', '2026-08-07 15:58:58'),
(158, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 15:58:58', '2026-08-07 15:58:58', '2026-08-07 15:58:58'),
(159, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 15:59:26', '2026-08-07 15:59:26', '2026-08-07 15:59:26'),
(160, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:04:26', '2026-08-07 16:04:26', '2026-08-07 16:04:26'),
(161, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:07:19', '2026-08-07 16:07:19', '2026-08-07 16:07:19'),
(162, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:07:42', '2026-08-07 16:07:42', '2026-08-07 16:07:42'),
(163, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:17:30', '2026-08-07 16:17:30', '2026-08-07 16:17:30'),
(164, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:17:31', '2026-08-07 16:17:31', '2026-08-07 16:17:31'),
(165, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:18:09', '2026-08-07 16:18:09', '2026-08-07 16:18:09'),
(166, 27, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:18:15', '2026-08-07 16:18:15', '2026-08-07 16:18:15'),
(167, 28, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:25:01', '2026-08-07 16:25:01', '2026-08-07 16:25:01'),
(168, 28, 22.0038859, 96.1614154, 241.00, 0.00, 0.00, '2026-08-07 16:25:03', '2026-08-07 16:25:03', '2026-08-07 16:25:03'),
(169, 29, 31.5224000, 74.3577000, 241.00, 0.00, 0.00, '2026-08-07 23:07:27', '2026-08-07 16:34:32', '2026-08-07 16:37:27'),
(170, 29, 31.5227000, 74.3579000, 241.00, 0.00, 0.00, '2026-08-07 23:07:27', '2026-08-07 16:34:38', '2026-08-07 16:37:27'),
(171, 29, 31.5230000, 74.3581000, 241.00, 0.00, 0.00, '2026-08-07 23:07:27', '2026-08-07 16:35:36', '2026-08-07 16:37:27'),
(172, 31, 31.5222000, 74.3587000, 15.00, 0.00, 18.00, '2026-08-07 16:45:54', '2026-08-07 16:45:54', '2026-08-07 16:45:54'),
(173, 31, 31.5220909, 74.3593172, 15.00, 20.05, 18.00, '2026-08-07 16:46:00', '2026-08-07 16:46:00', '2026-08-07 16:46:00'),
(174, 31, 31.5217767, 74.3598596, 15.00, 40.11, 18.00, '2026-08-07 16:46:04', '2026-08-07 16:46:04', '2026-08-07 16:46:04'),
(175, 31, 31.5212956, 74.3602614, 15.00, 60.16, 18.00, '2026-08-07 16:46:09', '2026-08-07 16:46:09', '2026-08-07 16:46:09'),
(176, 31, 31.5207059, 74.3604738, 15.00, 80.21, 18.00, '2026-08-07 16:46:13', '2026-08-07 16:46:13', '2026-08-07 16:46:13'),
(177, 31, 31.5200792, 74.3604712, 15.00, 100.27, 18.00, '2026-08-07 16:46:18', '2026-08-07 16:46:18', '2026-08-07 16:46:18'),
(178, 31, 31.5194913, 74.3602538, 15.00, 120.32, 18.00, '2026-08-07 16:46:23', '2026-08-07 16:46:23', '2026-08-07 16:46:23'),
(179, 31, 31.5190136, 74.3598480, 15.00, 140.37, 18.00, '2026-08-07 16:46:28', '2026-08-07 16:46:28', '2026-08-07 16:46:28'),
(180, 31, 31.5187040, 74.3593030, 15.00, 160.43, 18.00, '2026-08-07 16:46:32', '2026-08-07 16:46:32', '2026-08-07 16:46:32'),
(181, 31, 31.5186001, 74.3586849, 15.00, 180.48, 18.00, '2026-08-07 16:46:36', '2026-08-07 16:46:36', '2026-08-07 16:46:36'),
(182, 31, 31.5187144, 74.3580686, 15.00, 200.54, 18.00, '2026-08-07 16:46:43', '2026-08-07 16:46:43', '2026-08-07 16:46:43'),
(183, 31, 31.5190331, 74.3575289, 15.00, 220.59, 18.00, '2026-08-07 16:46:50', '2026-08-07 16:46:50', '2026-08-07 16:46:50'),
(184, 31, 31.5195175, 74.3571312, 15.00, 240.64, 18.00, '2026-08-07 16:46:56', '2026-08-07 16:46:56', '2026-08-07 16:46:56'),
(185, 31, 31.5201090, 74.3569237, 15.00, 260.70, 18.00, '2026-08-07 16:47:05', '2026-08-07 16:47:05', '2026-08-07 16:47:05'),
(186, 31, 31.5207357, 74.3569316, 15.00, 280.75, 18.00, '2026-08-07 16:47:08', '2026-08-07 16:47:08', '2026-08-07 16:47:08'),
(187, 31, 31.5213218, 74.3571539, 15.00, 300.80, 18.00, '2026-08-07 16:47:12', '2026-08-07 16:47:12', '2026-08-07 16:47:12'),
(188, 31, 31.5217960, 74.3575637, 15.00, 320.86, 18.00, '2026-08-07 16:47:14', '2026-08-07 16:47:14', '2026-08-07 16:47:14'),
(189, 31, 31.5221010, 74.3581113, 15.00, 340.91, 18.00, '2026-08-07 16:47:16', '2026-08-07 16:47:16', '2026-08-07 16:47:16'),
(190, 31, 31.5221997, 74.3587303, 15.00, 0.96, 18.00, '2026-08-07 16:47:17', '2026-08-07 16:47:17', '2026-08-07 16:47:17'),
(191, 31, 31.5220803, 74.3593456, 15.00, 21.02, 18.00, '2026-08-07 16:47:19', '2026-08-07 16:47:19', '2026-08-07 16:47:19'),
(192, 31, 31.5217570, 74.3598826, 15.00, 41.07, 18.00, '2026-08-07 16:47:20', '2026-08-07 16:47:20', '2026-08-07 16:47:20'),
(193, 31, 31.5212692, 74.3602762, 15.00, 61.12, 18.00, '2026-08-07 16:47:21', '2026-08-07 16:47:21', '2026-08-07 16:47:21'),
(194, 31, 31.5206761, 74.3604787, 15.00, 81.18, 18.00, '2026-08-07 16:47:23', '2026-08-07 16:47:23', '2026-08-07 16:47:23'),
(195, 31, 31.5200494, 74.3604655, 15.00, 101.23, 18.00, '2026-08-07 16:47:26', '2026-08-07 16:47:26', '2026-08-07 16:47:26'),
(196, 31, 31.5194653, 74.3602383, 15.00, 121.28, 18.00, '2026-08-07 16:47:29', '2026-08-07 16:47:29', '2026-08-07 16:47:29'),
(197, 31, 31.5189945, 74.3598245, 15.00, 141.34, 18.00, '2026-08-07 16:47:33', '2026-08-07 16:47:33', '2026-08-07 16:47:33'),
(198, 31, 31.5186941, 74.3592744, 15.00, 161.39, 18.00, '2026-08-07 16:47:37', '2026-08-07 16:47:37', '2026-08-07 16:47:37'),
(199, 31, 31.5186006, 74.3586546, 15.00, 181.45, 18.00, '2026-08-07 16:47:41', '2026-08-07 16:47:41', '2026-08-07 16:47:41'),
(200, 31, 31.5187252, 74.3580403, 15.00, 201.50, 18.00, '2026-08-07 16:47:45', '2026-08-07 16:47:45', '2026-08-07 16:47:45'),
(201, 31, 31.5190530, 74.3575061, 15.00, 221.55, 18.00, '2026-08-07 16:47:50', '2026-08-07 16:47:50', '2026-08-07 16:47:50'),
(202, 31, 31.5195440, 74.3571165, 15.00, 241.61, 18.00, '2026-08-07 16:47:54', '2026-08-07 16:47:54', '2026-08-07 16:47:54'),
(203, 31, 31.5201389, 74.3569190, 15.00, 261.66, 18.00, '2026-08-07 16:47:58', '2026-08-07 16:47:58', '2026-08-07 16:47:58'),
(204, 31, 31.5207654, 74.3569375, 15.00, 281.71, 18.00, '2026-08-07 16:48:03', '2026-08-07 16:48:03', '2026-08-07 16:48:03'),
(205, 31, 31.5213476, 74.3571696, 15.00, 301.77, 18.00, '2026-08-07 16:48:06', '2026-08-07 16:48:06', '2026-08-07 16:48:06'),
(206, 31, 31.5218149, 74.3575874, 15.00, 321.82, 18.00, '2026-08-07 16:48:09', '2026-08-07 16:48:09', '2026-08-07 16:48:09'),
(207, 31, 31.5221107, 74.3581400, 15.00, 341.87, 18.00, '2026-08-07 16:48:14', '2026-08-07 16:48:14', '2026-08-07 16:48:14'),
(208, 31, 31.5221990, 74.3587605, 15.00, 1.93, 18.00, '2026-08-07 16:48:17', '2026-08-07 16:48:17', '2026-08-07 16:48:17'),
(209, 31, 31.5220692, 74.3593737, 15.00, 21.98, 18.00, '2026-08-07 16:48:21', '2026-08-07 16:48:21', '2026-08-07 16:48:21'),
(210, 31, 31.5217369, 74.3599052, 15.00, 42.03, 18.00, '2026-08-07 16:48:26', '2026-08-07 16:48:26', '2026-08-07 16:48:26'),
(211, 31, 31.5212426, 74.3602906, 15.00, 62.09, 18.00, '2026-08-07 16:48:29', '2026-08-07 16:48:29', '2026-08-07 16:48:29'),
(212, 31, 31.5206461, 74.3604831, 15.00, 82.14, 18.00, '2026-08-07 16:48:34', '2026-08-07 16:48:34', '2026-08-07 16:48:34'),
(213, 31, 31.5200198, 74.3604594, 15.00, 102.19, 18.00, '2026-08-07 16:48:37', '2026-08-07 16:48:37', '2026-08-07 16:48:37'),
(214, 31, 31.5194395, 74.3602223, 15.00, 122.25, 18.00, '2026-08-07 16:48:41', '2026-08-07 16:48:41', '2026-08-07 16:48:41'),
(215, 31, 31.5189758, 74.3598007, 15.00, 142.30, 18.00, '2026-08-08 07:48:39', '2026-08-08 07:48:39', '2026-08-08 07:48:39'),
(216, 31, 31.5186847, 74.3592456, 15.00, 162.36, 18.00, '2026-08-08 07:48:40', '2026-08-08 07:48:40', '2026-08-08 07:48:40'),
(217, 31, 31.5186016, 74.3586244, 15.00, 182.41, 18.00, '2026-08-08 07:48:41', '2026-08-08 07:48:41', '2026-08-08 07:48:41'),
(218, 31, 31.5187366, 74.3580123, 15.00, 202.46, 18.00, '2026-08-08 07:48:43', '2026-08-08 07:48:43', '2026-08-08 07:48:43'),
(219, 31, 31.5190732, 74.3574836, 15.00, 222.52, 18.00, '2026-08-08 07:48:43', '2026-08-08 07:48:43', '2026-08-08 07:48:43'),
(220, 31, 31.5195708, 74.3571024, 15.00, 242.57, 18.00, '2026-08-08 07:48:54', '2026-08-08 07:48:54', '2026-08-08 07:48:54'),
(221, 31, 31.5201689, 74.3569149, 15.00, 262.62, 18.00, '2026-08-08 07:48:57', '2026-08-08 07:48:57', '2026-08-08 07:48:57'),
(222, 31, 31.5207950, 74.3569439, 15.00, 282.68, 18.00, '2026-08-08 07:48:57', '2026-08-08 07:48:57', '2026-08-08 07:48:57'),
(223, 31, 31.5213732, 74.3571858, 15.00, 302.73, 18.00, '2026-08-08 07:48:59', '2026-08-08 07:48:59', '2026-08-08 07:48:59'),
(224, 31, 31.5218334, 74.3576113, 15.00, 322.78, 18.00, '2026-08-08 07:49:02', '2026-08-08 07:49:02', '2026-08-08 07:49:02'),
(225, 31, 31.5221198, 74.3581688, 15.00, 342.84, 18.00, '2026-08-08 07:49:09', '2026-08-08 07:49:09', '2026-08-08 07:49:09'),
(226, 31, 31.5221977, 74.3587908, 15.00, 2.89, 18.00, '2026-08-08 07:49:10', '2026-08-08 07:49:10', '2026-08-08 07:49:10'),
(227, 31, 31.5220576, 74.3594017, 15.00, 22.94, 18.00, '2026-08-08 07:49:13', '2026-08-08 07:49:13', '2026-08-08 07:49:13'),
(228, 31, 31.5217165, 74.3599275, 15.00, 43.00, 18.00, '2026-08-08 07:49:24', '2026-08-08 07:49:24', '2026-08-08 07:49:24'),
(229, 31, 31.5212158, 74.3603045, 15.00, 63.05, 18.00, '2026-08-08 07:49:29', '2026-08-08 07:49:29', '2026-08-08 07:49:29'),
(230, 31, 31.5206161, 74.3604870, 15.00, 83.10, 18.00, '2026-08-08 07:49:31', '2026-08-08 07:49:31', '2026-08-08 07:49:31'),
(231, 31, 31.5199903, 74.3604527, 15.00, 103.16, 18.00, '2026-08-08 07:49:40', '2026-08-08 07:49:40', '2026-08-08 07:49:40'),
(232, 31, 31.5194141, 74.3602060, 15.00, 123.21, 18.00, '2026-08-08 07:49:42', '2026-08-08 07:49:42', '2026-08-08 07:49:42'),
(233, 31, 31.5189575, 74.3597766, 15.00, 143.26, 18.00, '2026-08-08 07:49:46', '2026-08-08 07:49:46', '2026-08-08 07:49:46'),
(234, 31, 31.5186758, 74.3592167, 15.00, 163.32, 18.00, '2026-08-08 07:49:55', '2026-08-08 07:49:55', '2026-08-08 07:49:55'),
(235, 31, 31.5186031, 74.3585941, 15.00, 183.37, 18.00, '2026-08-08 07:49:56', '2026-08-08 07:49:56', '2026-08-08 07:49:56'),
(236, 31, 31.5187484, 74.3579844, 15.00, 203.43, 18.00, '2026-08-08 07:50:02', '2026-08-08 07:50:02', '2026-08-08 07:50:02'),
(237, 31, 31.5190939, 74.3574614, 15.00, 223.48, 18.00, '2026-08-08 07:50:04', '2026-08-08 07:50:04', '2026-08-08 07:50:04'),
(238, 31, 31.5195978, 74.3570887, 15.00, 243.53, 18.00, '2026-08-08 07:50:10', '2026-08-08 07:50:10', '2026-08-08 07:50:10'),
(239, 31, 31.5201989, 74.3569113, 15.00, 263.59, 18.00, '2026-08-08 07:50:37', '2026-08-08 07:50:37', '2026-08-08 07:50:37'),
(240, 31, 31.5208245, 74.3569508, 15.00, 283.64, 18.00, '2026-08-08 07:50:47', '2026-08-08 07:50:47', '2026-08-08 07:50:47'),
(241, 31, 31.5213985, 74.3572024, 15.00, 303.69, 18.00, '2026-08-08 07:50:48', '2026-08-08 07:50:48', '2026-08-08 07:50:48'),
(242, 31, 31.5218515, 74.3576356, 15.00, 323.75, 18.00, '2026-08-08 07:50:50', '2026-08-08 07:50:50', '2026-08-08 07:50:50'),
(243, 31, 31.5221285, 74.3581978, 15.00, 343.80, 18.00, '2026-08-08 07:50:53', '2026-08-08 07:50:53', '2026-08-08 07:50:53'),
(244, 31, 31.5221959, 74.3588210, 15.00, 3.85, 18.00, '2026-08-08 07:50:58', '2026-08-08 07:50:58', '2026-08-08 07:50:58'),
(245, 31, 31.5220456, 74.3594295, 15.00, 23.91, 18.00, '2026-08-08 07:51:06', '2026-08-08 07:51:06', '2026-08-08 07:51:06'),
(246, 31, 31.5216957, 74.3599495, 15.00, 43.96, 18.00, '2026-08-08 07:51:10', '2026-08-08 07:51:10', '2026-08-08 07:51:10'),
(247, 31, 31.5211887, 74.3603180, 15.00, 64.01, 18.00, '2026-08-08 07:51:11', '2026-08-08 07:51:11', '2026-08-08 07:51:11'),
(248, 31, 31.5205860, 74.3604904, 15.00, 84.07, 18.00, '2026-08-08 07:51:14', '2026-08-08 07:51:14', '2026-08-08 07:51:14'),
(249, 31, 31.5199608, 74.3604456, 15.00, 104.12, 18.00, '2026-08-08 07:51:17', '2026-08-08 07:51:17', '2026-08-08 07:51:17'),
(250, 31, 31.5193889, 74.3601892, 15.00, 124.17, 18.00, '2026-08-08 07:51:21', '2026-08-08 07:51:21', '2026-08-08 07:51:21'),
(251, 31, 31.5189396, 74.3597522, 15.00, 144.23, 18.00, '2026-08-08 07:51:26', '2026-08-08 07:51:26', '2026-08-08 07:51:26'),
(252, 31, 31.5186673, 74.3591876, 15.00, 164.28, 18.00, '2026-08-08 07:51:32', '2026-08-08 07:51:32', '2026-08-08 07:51:32'),
(253, 31, 31.5186052, 74.3585639, 15.00, 184.34, 18.00, '2026-08-08 07:51:35', '2026-08-08 07:51:35', '2026-08-08 07:51:35'),
(254, 31, 31.5187606, 74.3579567, 15.00, 204.39, 18.00, '2026-08-08 07:51:39', '2026-08-08 07:51:39', '2026-08-08 07:51:39'),
(255, 31, 31.5191149, 74.3574397, 15.00, 224.44, 18.00, '2026-08-08 07:51:42', '2026-08-08 07:51:42', '2026-08-08 07:51:42'),
(256, 31, 31.5196250, 74.3570754, 15.00, 244.50, 18.00, '2026-08-08 07:51:46', '2026-08-08 07:51:46', '2026-08-08 07:51:46'),
(257, 31, 31.5202290, 74.3569081, 15.00, 264.55, 18.00, '2026-08-08 07:51:50', '2026-08-08 07:51:50', '2026-08-08 07:51:50'),
(258, 31, 31.5208538, 74.3569581, 15.00, 284.60, 18.00, '2026-08-08 07:51:53', '2026-08-08 07:51:53', '2026-08-08 07:51:53'),
(259, 31, 31.5214236, 74.3572194, 15.00, 304.66, 18.00, '2026-08-08 07:51:58', '2026-08-08 07:51:58', '2026-08-08 07:51:58'),
(260, 31, 31.5218692, 74.3576601, 15.00, 324.71, 18.00, '2026-08-08 07:52:02', '2026-08-08 07:52:02', '2026-08-08 07:52:02'),
(261, 31, 31.5221367, 74.3582270, 15.00, 344.76, 18.00, '2026-08-08 07:52:06', '2026-08-08 07:52:06', '2026-08-08 07:52:06'),
(262, 31, 31.5221936, 74.3588512, 15.00, 4.82, 18.00, '2026-08-08 07:52:10', '2026-08-08 07:52:10', '2026-08-08 07:52:10'),
(263, 31, 31.5220331, 74.3594570, 15.00, 24.87, 18.00, '2026-08-08 07:52:25', '2026-08-08 07:52:25', '2026-08-08 07:52:25'),
(264, 31, 31.5216745, 74.3599711, 15.00, 44.92, 18.00, '2026-08-08 07:52:32', '2026-08-08 07:52:32', '2026-08-08 07:52:32'),
(265, 31, 31.5211613, 74.3603311, 15.00, 64.98, 18.00, '2026-08-08 07:52:37', '2026-08-08 07:52:37', '2026-08-08 07:52:37'),
(266, 31, 31.5205559, 74.3604932, 15.00, 85.03, 18.00, '2026-08-08 07:52:38', '2026-08-08 07:52:38', '2026-08-08 07:52:38'),
(267, 31, 31.5199316, 74.3604380, 15.00, 105.08, 18.00, '2026-08-08 07:52:39', '2026-08-08 07:52:39', '2026-08-08 07:52:39'),
(268, 31, 31.5193640, 74.3601720, 15.00, 125.14, 18.00, '2026-08-08 07:52:42', '2026-08-08 07:52:42', '2026-08-08 07:52:42'),
(269, 31, 31.5189221, 74.3597275, 15.00, 145.19, 18.00, '2026-08-08 07:52:45', '2026-08-08 07:52:45', '2026-08-08 07:52:45'),
(270, 31, 31.5186594, 74.3591584, 15.00, 165.25, 18.00, '2026-08-08 07:52:49', '2026-08-08 07:52:49', '2026-08-08 07:52:49'),
(271, 31, 31.5186077, 74.3585338, 15.00, 185.30, 18.00, '2026-08-08 07:52:53', '2026-08-08 07:52:53', '2026-08-08 07:52:53'),
(272, 31, 31.5187734, 74.3579293, 15.00, 205.35, 18.00, '2026-08-08 07:52:57', '2026-08-08 07:52:57', '2026-08-08 07:52:57'),
(273, 31, 31.5191363, 74.3574182, 15.00, 225.41, 18.00, '2026-08-08 07:53:01', '2026-08-08 07:53:01', '2026-08-08 07:53:01'),
(274, 31, 31.5196524, 74.3570626, 15.00, 245.46, 18.00, '2026-08-08 07:53:05', '2026-08-08 07:53:05', '2026-08-08 07:53:05'),
(275, 31, 31.5202592, 74.3569055, 15.00, 265.51, 18.00, '2026-08-08 07:53:09', '2026-08-08 07:53:09', '2026-08-08 07:53:09'),
(276, 31, 31.5208830, 74.3569660, 15.00, 285.57, 18.00, '2026-08-08 07:53:13', '2026-08-08 07:53:13', '2026-08-08 07:53:13'),
(277, 31, 31.5214483, 74.3572368, 15.00, 305.62, 18.00, '2026-08-08 07:53:17', '2026-08-08 07:53:17', '2026-08-08 07:53:17'),
(278, 31, 31.5218865, 74.3576850, 15.00, 325.67, 18.00, '2026-08-08 07:53:22', '2026-08-08 07:53:22', '2026-08-08 07:53:22'),
(279, 31, 31.5221444, 74.3582562, 15.00, 345.73, 18.00, '2026-08-08 07:53:25', '2026-08-08 07:53:25', '2026-08-08 07:53:25'),
(280, 31, 31.5221908, 74.3588813, 15.00, 5.78, 18.00, '2026-08-08 07:53:29', '2026-08-08 07:53:29', '2026-08-08 07:53:29'),
(281, 31, 31.5220201, 74.3594844, 15.00, 25.83, 18.00, '2026-08-08 07:53:33', '2026-08-08 07:53:33', '2026-08-08 07:53:33'),
(282, 31, 31.5216529, 74.3599924, 15.00, 45.89, 18.00, '2026-08-08 07:53:38', '2026-08-08 07:53:38', '2026-08-08 07:53:38'),
(283, 31, 31.5211338, 74.3603436, 15.00, 65.94, 18.00, '2026-08-08 07:53:41', '2026-08-08 07:53:41', '2026-08-08 07:53:41'),
(284, 31, 31.5205257, 74.3604956, 15.00, 85.99, 18.00, '2026-08-08 07:53:45', '2026-08-08 07:53:45', '2026-08-08 07:53:45'),
(285, 31, 31.5199024, 74.3604299, 15.00, 106.05, 18.00, '2026-08-08 07:53:49', '2026-08-08 07:53:49', '2026-08-08 07:53:49'),
(286, 31, 31.5193394, 74.3601544, 15.00, 126.10, 18.00, '2026-08-08 07:53:53', '2026-08-08 07:53:53', '2026-08-08 07:53:53'),
(287, 31, 31.5189050, 74.3597025, 15.00, 146.16, 18.00, '2026-08-08 07:53:57', '2026-08-08 07:53:57', '2026-08-08 07:53:57'),
(288, 31, 31.5186519, 74.3591291, 15.00, 166.21, 18.00, '2026-08-08 07:54:02', '2026-08-08 07:54:02', '2026-08-08 07:54:02'),
(289, 31, 31.5186107, 74.3585037, 15.00, 186.26, 18.00, '2026-08-08 07:54:05', '2026-08-08 07:54:05', '2026-08-08 07:54:05'),
(290, 31, 31.5187865, 74.3579020, 15.00, 206.32, 18.00, '2026-08-08 07:54:10', '2026-08-08 07:54:10', '2026-08-08 07:54:10'),
(291, 31, 31.5191580, 74.3573972, 15.00, 226.37, 18.00, '2026-08-08 07:54:14', '2026-08-08 07:54:14', '2026-08-08 07:54:14'),
(292, 31, 31.5196800, 74.3570503, 15.00, 246.42, 18.00, '2026-08-08 07:54:17', '2026-08-08 07:54:17', '2026-08-08 07:54:17'),
(293, 31, 31.5202894, 74.3569034, 15.00, 266.48, 18.00, '2026-08-08 07:54:21', '2026-08-08 07:54:21', '2026-08-08 07:54:21'),
(294, 31, 31.5209121, 74.3569744, 15.00, 286.53, 18.00, '2026-08-08 07:54:25', '2026-08-08 07:54:25', '2026-08-08 07:54:25'),
(295, 31, 31.5214728, 74.3572546, 15.00, 306.58, 18.00, '2026-08-08 07:54:29', '2026-08-08 07:54:29', '2026-08-08 07:54:29'),
(296, 31, 31.5219034, 74.3577101, 15.00, 326.64, 18.00, '2026-08-08 07:54:33', '2026-08-08 07:54:33', '2026-08-08 07:54:33'),
(297, 31, 31.5221517, 74.3582856, 15.00, 346.69, 18.00, '2026-08-08 07:54:37', '2026-08-08 07:54:37', '2026-08-08 07:54:37'),
(298, 31, 31.5221875, 74.3589114, 15.00, 6.74, 18.00, '2026-08-08 07:54:41', '2026-08-08 07:54:41', '2026-08-08 07:54:41'),
(299, 31, 31.5220067, 74.3595115, 15.00, 26.80, 18.00, '2026-08-08 07:54:45', '2026-08-08 07:54:45', '2026-08-08 07:54:45'),
(300, 31, 31.5216310, 74.3600132, 15.00, 46.85, 18.00, '2026-08-08 07:54:49', '2026-08-08 07:54:49', '2026-08-08 07:54:49'),
(301, 31, 31.5211061, 74.3603557, 15.00, 66.90, 18.00, '2026-08-08 07:54:53', '2026-08-08 07:54:53', '2026-08-08 07:54:53'),
(302, 31, 31.5204955, 74.3604975, 15.00, 86.96, 18.00, '2026-08-08 07:54:57', '2026-08-08 07:54:57', '2026-08-08 07:54:57'),
(303, 31, 31.5198734, 74.3604212, 15.00, 107.01, 18.00, '2026-08-08 07:55:01', '2026-08-08 07:55:01', '2026-08-08 07:55:01'),
(304, 31, 31.5193151, 74.3601363, 15.00, 127.07, 18.00, '2026-08-08 07:55:05', '2026-08-08 07:55:05', '2026-08-08 07:55:05'),
(305, 31, 31.5188884, 74.3596772, 15.00, 147.12, 18.00, '2026-08-08 07:55:09', '2026-08-08 07:55:09', '2026-08-08 07:55:09'),
(306, 31, 31.5186449, 74.3590996, 15.00, 167.17, 18.00, '2026-08-08 07:55:13', '2026-08-08 07:55:13', '2026-08-08 07:55:13'),
(307, 31, 31.5186143, 74.3584736, 15.00, 187.23, 18.00, '2026-08-08 07:55:17', '2026-08-08 07:55:17', '2026-08-08 07:55:17'),
(308, 31, 31.5188002, 74.3578750, 15.00, 207.28, 18.00, '2026-08-08 07:55:21', '2026-08-08 07:55:21', '2026-08-08 07:55:21'),
(309, 31, 31.5191801, 74.3573765, 15.00, 227.33, 18.00, '2026-08-08 07:55:25', '2026-08-08 07:55:25', '2026-08-08 07:55:25'),
(310, 31, 31.5197079, 74.3570384, 15.00, 247.39, 18.00, '2026-08-08 07:55:29', '2026-08-08 07:55:29', '2026-08-08 07:55:29'),
(311, 31, 31.5203196, 74.3569018, 15.00, 267.44, 18.00, '2026-08-08 07:55:33', '2026-08-08 07:55:33', '2026-08-08 07:55:33'),
(312, 31, 31.5209411, 74.3569832, 15.00, 287.49, 18.00, '2026-08-08 07:55:37', '2026-08-08 07:55:37', '2026-08-08 07:55:37'),
(313, 31, 31.5214969, 74.3572729, 15.00, 307.55, 18.00, '2026-08-08 07:55:41', '2026-08-08 07:55:41', '2026-08-08 07:55:41'),
(314, 31, 31.5219198, 74.3577355, 15.00, 327.60, 18.00, '2026-08-08 07:55:45', '2026-08-08 07:55:45', '2026-08-08 07:55:45'),
(315, 31, 31.5221584, 74.3583151, 15.00, 347.65, 18.00, '2026-08-08 07:55:49', '2026-08-08 07:55:49', '2026-08-08 07:55:49'),
(316, 31, 31.5221837, 74.3589414, 15.00, 7.71, 18.00, '2026-08-08 07:55:53', '2026-08-08 07:55:53', '2026-08-08 07:55:53'),
(317, 31, 31.5219928, 74.3595384, 15.00, 27.76, 18.00, '2026-08-08 07:55:57', '2026-08-08 07:55:57', '2026-08-08 07:55:57'),
(318, 31, 31.5216088, 74.3600338, 15.00, 47.81, 18.00, '2026-08-08 07:56:01', '2026-08-08 07:56:01', '2026-08-08 07:56:01'),
(319, 31, 31.5210781, 74.3603674, 15.00, 67.87, 18.00, '2026-08-08 07:56:05', '2026-08-08 07:56:05', '2026-08-08 07:56:05'),
(320, 31, 31.5204653, 74.3604988, 15.00, 87.92, 18.00, '2026-08-08 07:56:09', '2026-08-08 07:56:09', '2026-08-08 07:56:09'),
(321, 31, 31.5198445, 74.3604121, 15.00, 107.97, 18.00, '2026-08-08 07:56:13', '2026-08-08 07:56:13', '2026-08-08 07:56:13'),
(322, 31, 31.5192911, 74.3601179, 15.00, 128.03, 18.00, '2026-08-08 07:56:17', '2026-08-08 07:56:17', '2026-08-08 07:56:17'),
(323, 31, 31.5188722, 74.3596517, 15.00, 148.08, 18.00, '2026-08-08 07:56:21', '2026-08-08 07:56:21', '2026-08-08 07:56:21'),
(324, 31, 31.5186385, 74.3590701, 15.00, 168.14, 18.00, '2026-08-08 07:56:25', '2026-08-08 07:56:25', '2026-08-08 07:56:25'),
(325, 31, 31.5186184, 74.3584436, 15.00, 188.19, 18.00, '2026-08-08 07:56:30', '2026-08-08 07:56:30', '2026-08-08 07:56:30'),
(326, 31, 31.5188143, 74.3578482, 15.00, 208.24, 18.00, '2026-08-08 07:56:32', '2026-08-08 07:56:32', '2026-08-08 07:56:32'),
(327, 31, 31.5192025, 74.3573561, 15.00, 228.30, 18.00, '2026-08-08 07:56:37', '2026-08-08 07:56:37', '2026-08-08 07:56:37'),
(328, 31, 31.5197359, 74.3570270, 15.00, 248.35, 18.00, '2026-08-08 07:56:43', '2026-08-08 07:56:43', '2026-08-08 07:56:43'),
(329, 31, 31.5203498, 74.3569007, 15.00, 268.40, 18.00, '2026-08-08 07:56:47', '2026-08-08 07:56:47', '2026-08-08 07:56:47'),
(330, 31, 31.5209699, 74.3569926, 15.00, 288.46, 18.00, '2026-08-08 07:56:50', '2026-08-08 07:56:50', '2026-08-08 07:56:50'),
(331, 31, 31.5215208, 74.3572915, 15.00, 308.51, 18.00, '2026-08-08 07:56:53', '2026-08-08 07:56:53', '2026-08-08 07:56:53'),
(332, 31, 31.5219358, 74.3577612, 15.00, 328.56, 18.00, '2026-08-08 07:56:57', '2026-08-08 07:56:57', '2026-08-08 07:56:57'),
(333, 31, 31.5221646, 74.3583447, 15.00, 348.62, 18.00, '2026-08-08 07:57:01', '2026-08-08 07:57:01', '2026-08-08 07:57:01'),
(334, 31, 31.5221794, 74.3589714, 15.00, 8.67, 18.00, '2026-08-08 07:57:05', '2026-08-08 07:57:05', '2026-08-08 07:57:05'),
(335, 31, 31.5219785, 74.3595651, 15.00, 28.72, 18.00, '2026-08-08 07:57:09', '2026-08-08 07:57:09', '2026-08-08 07:57:09'),
(336, 31, 31.5215862, 74.3600539, 15.00, 48.78, 18.00, '2026-08-08 07:57:13', '2026-08-08 07:57:13', '2026-08-08 07:57:13'),
(337, 31, 31.5210500, 74.3603785, 15.00, 68.83, 18.00, '2026-08-08 07:57:17', '2026-08-08 07:57:17', '2026-08-08 07:57:17'),
(338, 31, 31.5204350, 74.3604997, 15.00, 88.88, 18.00, '2026-08-08 07:57:23', '2026-08-08 07:57:23', '2026-08-08 07:57:23'),
(339, 31, 31.5198158, 74.3604026, 15.00, 108.94, 18.00, '2026-08-08 07:57:25', '2026-08-08 07:57:25', '2026-08-08 07:57:25'),
(340, 31, 31.5192674, 74.3600990, 15.00, 128.99, 18.00, '2026-08-08 07:57:30', '2026-08-08 07:57:30', '2026-08-08 07:57:30'),
(341, 31, 31.5188564, 74.3596258, 15.00, 149.05, 18.00, '2026-08-08 07:57:37', '2026-08-08 07:57:37', '2026-08-08 07:57:37'),
(342, 31, 31.5186325, 74.3590404, 15.00, 169.10, 18.00, '2026-08-08 07:57:38', '2026-08-08 07:57:38', '2026-08-08 07:57:38'),
(343, 31, 31.5186229, 74.3584137, 15.00, 189.15, 18.00, '2026-08-08 07:57:40', '2026-08-08 07:57:40', '2026-08-08 07:57:40'),
(344, 31, 31.5188288, 74.3578217, 15.00, 209.21, 18.00, '2026-08-08 07:57:44', '2026-08-08 07:57:44', '2026-08-08 07:57:44'),
(345, 31, 31.5192253, 74.3573362, 15.00, 229.26, 18.00, '2026-08-08 07:57:48', '2026-08-08 07:57:48', '2026-08-08 07:57:48'),
(346, 31, 31.5197641, 74.3570161, 15.00, 249.31, 18.00, '2026-08-08 07:57:53', '2026-08-08 07:57:53', '2026-08-08 07:57:53'),
(347, 31, 31.5203801, 74.3569001, 15.00, 269.37, 18.00, '2026-08-08 07:57:57', '2026-08-08 07:57:57', '2026-08-08 07:57:57'),
(348, 31, 31.5209985, 74.3570024, 15.00, 289.42, 18.00, '2026-08-08 07:58:00', '2026-08-08 07:58:00', '2026-08-08 07:58:00'),
(349, 31, 31.5215443, 74.3573105, 15.00, 309.47, 18.00, '2026-08-08 07:58:05', '2026-08-08 07:58:05', '2026-08-08 07:58:05'),
(350, 31, 31.5219514, 74.3577872, 15.00, 329.53, 18.00, '2026-08-08 07:58:08', '2026-08-08 07:58:08', '2026-08-08 07:58:08'),
(351, 31, 31.5221703, 74.3583745, 15.00, 349.58, 18.00, '2026-08-08 07:58:13', '2026-08-08 07:58:13', '2026-08-08 07:58:13'),
(352, 31, 31.5221746, 74.3590012, 15.00, 9.63, 18.00, '2026-08-08 07:58:17', '2026-08-08 07:58:17', '2026-08-08 07:58:17'),
(353, 31, 31.5219637, 74.3595915, 15.00, 29.69, 18.00, '2026-08-08 07:58:20', '2026-08-08 07:58:20', '2026-08-08 07:58:20'),
(354, 31, 31.5215632, 74.3600736, 15.00, 49.74, 18.00, '2026-08-08 07:58:24', '2026-08-08 07:58:24', '2026-08-08 07:58:24'),
(355, 31, 31.5210217, 74.3603892, 15.00, 69.79, 18.00, '2026-08-08 07:58:28', '2026-08-08 07:58:28', '2026-08-08 07:58:28'),
(356, 31, 31.5204048, 74.3605000, 15.00, 89.85, 18.00, '2026-08-08 07:58:33', '2026-08-08 07:58:33', '2026-08-08 07:58:33'),
(357, 31, 31.5197873, 74.3603925, 15.00, 109.90, 18.00, '2026-08-08 07:58:38', '2026-08-08 07:58:38', '2026-08-08 07:58:38'),
(358, 31, 31.5192441, 74.3600798, 15.00, 129.96, 18.00, '2026-08-08 07:58:41', '2026-08-08 07:58:41', '2026-08-08 07:58:41'),
(359, 31, 31.5188410, 74.3595998, 15.00, 150.01, 18.00, '2026-08-08 07:58:45', '2026-08-08 07:58:45', '2026-08-08 07:58:45'),
(360, 31, 31.5186270, 74.3590106, 15.00, 170.06, 18.00, '2026-08-08 07:58:49', '2026-08-08 07:58:49', '2026-08-08 07:58:49'),
(361, 31, 31.5186280, 74.3583839, 15.00, 190.12, 18.00, '2026-08-08 07:58:53', '2026-08-08 07:58:53', '2026-08-08 07:58:53'),
(362, 31, 31.5188438, 74.3577954, 15.00, 210.17, 18.00, '2026-08-08 07:58:57', '2026-08-08 07:58:57', '2026-08-08 07:58:57'),
(363, 31, 31.5192484, 74.3573166, 15.00, 230.22, 18.00, '2026-08-08 07:59:01', '2026-08-08 07:59:01', '2026-08-08 07:59:01'),
(364, 31, 31.5197925, 74.3570056, 15.00, 250.28, 18.00, '2026-08-08 07:59:05', '2026-08-08 07:59:05', '2026-08-08 07:59:05'),
(365, 31, 31.5204104, 74.3569000, 15.00, 270.33, 18.00, '2026-08-08 07:59:09', '2026-08-08 07:59:09', '2026-08-08 07:59:09'),
(366, 31, 31.5210269, 74.3570127, 15.00, 290.38, 18.00, '2026-08-08 07:59:13', '2026-08-08 07:59:13', '2026-08-08 07:59:13'),
(367, 31, 31.5215675, 74.3573300, 15.00, 310.44, 18.00, '2026-08-08 07:59:17', '2026-08-08 07:59:17', '2026-08-08 07:59:17'),
(368, 31, 31.5219665, 74.3578134, 15.00, 330.49, 18.00, '2026-08-08 07:59:20', '2026-08-08 07:59:20', '2026-08-08 07:59:20'),
(369, 31, 31.5221755, 74.3584043, 15.00, 350.54, 18.00, '2026-08-08 07:59:25', '2026-08-08 07:59:25', '2026-08-08 07:59:25'),
(370, 31, 31.5221693, 74.3590310, 15.00, 10.60, 18.00, '2026-08-08 07:59:28', '2026-08-08 07:59:28', '2026-08-08 07:59:28'),
(371, 31, 31.5219485, 74.3596177, 15.00, 30.65, 18.00, '2026-08-08 07:59:33', '2026-08-08 07:59:33', '2026-08-08 07:59:33'),
(372, 31, 31.5215400, 74.3600930, 15.00, 50.70, 18.00, '2026-08-08 07:59:36', '2026-08-08 07:59:36', '2026-08-08 07:59:36'),
(373, 31, 31.5209932, 74.3603994, 15.00, 70.76, 18.00, '2026-08-08 07:59:40', '2026-08-08 07:59:40', '2026-08-08 07:59:40'),
(374, 31, 31.5203745, 74.3604998, 15.00, 90.81, 18.00, '2026-08-08 07:59:44', '2026-08-08 07:59:44', '2026-08-08 07:59:44'),
(375, 31, 31.5197589, 74.3603820, 15.00, 110.87, 18.00, '2026-08-08 07:59:48', '2026-08-08 07:59:48', '2026-08-08 07:59:48'),
(376, 31, 31.5192210, 74.3600602, 15.00, 130.92, 18.00, '2026-08-08 07:59:52', '2026-08-08 07:59:52', '2026-08-08 07:59:52'),
(377, 31, 31.5188261, 74.3595734, 15.00, 150.97, 18.00, '2026-08-08 07:59:56', '2026-08-08 07:59:56', '2026-08-08 07:59:56'),
(378, 31, 31.5186220, 74.3589808, 15.00, 171.03, 18.00, '2026-08-08 08:00:00', '2026-08-08 08:00:00', '2026-08-08 08:00:00'),
(379, 31, 31.5186335, 74.3583541, 15.00, 191.08, 18.00, '2026-08-08 08:00:04', '2026-08-08 08:00:04', '2026-08-08 08:00:04'),
(380, 31, 31.5188593, 74.3577694, 15.00, 211.13, 18.00, '2026-08-08 08:00:08', '2026-08-08 08:00:08', '2026-08-08 08:00:08'),
(381, 31, 31.5192718, 74.3572975, 15.00, 231.19, 18.00, '2026-08-08 08:00:12', '2026-08-08 08:00:12', '2026-08-08 08:00:12'),
(382, 31, 31.5198211, 74.3569956, 15.00, 251.24, 18.00, '2026-08-08 08:00:16', '2026-08-08 08:00:16', '2026-08-08 08:00:16'),
(383, 31, 31.5204406, 74.3569005, 15.00, 271.29, 18.00, '2026-08-08 08:00:20', '2026-08-08 08:00:20', '2026-08-08 08:00:20'),
(384, 31, 31.5210552, 74.3570235, 15.00, 291.35, 18.00, '2026-08-08 08:00:24', '2026-08-08 08:00:24', '2026-08-08 08:00:24'),
(385, 31, 31.5215904, 74.3573498, 15.00, 311.40, 18.00, '2026-08-08 08:00:28', '2026-08-08 08:00:28', '2026-08-08 08:00:28'),
(386, 31, 31.5219812, 74.3578398, 15.00, 331.45, 18.00, '2026-08-08 08:00:32', '2026-08-08 08:00:32', '2026-08-08 08:00:32'),
(387, 31, 31.5221803, 74.3584342, 15.00, 351.51, 18.00, '2026-08-08 08:00:36', '2026-08-08 08:00:36', '2026-08-08 08:00:36'),
(388, 31, 31.5221635, 74.3590607, 15.00, 11.56, 18.00, '2026-08-08 08:00:40', '2026-08-08 08:00:40', '2026-08-08 08:00:40'),
(389, 31, 31.5219329, 74.3596436, 15.00, 31.61, 18.00, '2026-08-08 08:00:44', '2026-08-08 08:00:44', '2026-08-08 08:00:44'),
(390, 31, 31.5215164, 74.3601120, 15.00, 51.67, 18.00, '2026-08-08 08:00:48', '2026-08-08 08:00:48', '2026-08-08 08:00:48'),
(391, 31, 31.5209645, 74.3604092, 15.00, 71.72, 18.00, '2026-08-08 08:00:52', '2026-08-08 08:00:52', '2026-08-08 08:00:52'),
(392, 31, 31.5203442, 74.3604991, 15.00, 91.78, 18.00, '2026-08-08 08:00:56', '2026-08-08 08:00:56', '2026-08-08 08:00:56'),
(393, 31, 31.5197307, 74.3603709, 15.00, 111.83, 18.00, '2026-08-08 08:01:00', '2026-08-08 08:01:00', '2026-08-08 08:01:00'),
(394, 31, 31.5191983, 74.3600401, 15.00, 131.88, 18.00, '2026-08-08 08:01:04', '2026-08-08 08:01:04', '2026-08-08 08:01:04'),
(395, 31, 31.5188116, 74.3595468, 15.00, 151.94, 18.00, '2026-08-08 08:01:08', '2026-08-08 08:01:08', '2026-08-08 08:01:08'),
(396, 31, 31.5186176, 74.3589509, 15.00, 171.99, 18.00, '2026-08-08 08:01:12', '2026-08-08 08:01:12', '2026-08-08 08:01:12'),
(397, 31, 31.5186396, 74.3583244, 15.00, 192.04, 18.00, '2026-08-08 08:01:16', '2026-08-08 08:01:16', '2026-08-08 08:01:16'),
(398, 31, 31.5188751, 74.3577436, 15.00, 212.10, 18.00, '2026-08-08 08:01:20', '2026-08-08 08:01:20', '2026-08-08 08:01:20'),
(399, 31, 31.5192955, 74.3572787, 15.00, 232.15, 18.00, '2026-08-08 08:01:24', '2026-08-08 08:01:24', '2026-08-08 08:01:24'),
(400, 31, 31.5198498, 74.3569861, 15.00, 252.20, 18.00, '2026-08-08 08:01:28', '2026-08-08 08:01:28', '2026-08-08 08:01:28'),
(401, 31, 31.5204709, 74.3569014, 15.00, 272.26, 18.00, '2026-08-08 08:01:32', '2026-08-08 08:01:32', '2026-08-08 08:01:32'),
(402, 31, 31.5210833, 74.3570347, 15.00, 292.31, 18.00, '2026-08-08 08:01:36', '2026-08-08 08:01:36', '2026-08-08 08:01:36'),
(403, 31, 31.5216129, 74.3573700, 15.00, 312.36, 18.00, '2026-08-08 08:01:40', '2026-08-08 08:01:40', '2026-08-08 08:01:40'),
(404, 31, 31.5219954, 74.3578665, 15.00, 332.42, 18.00, '2026-08-08 08:01:44', '2026-08-08 08:01:44', '2026-08-08 08:01:44'),
(405, 31, 31.5221845, 74.3584641, 15.00, 352.47, 18.00, '2026-08-08 08:01:48', '2026-08-08 08:01:48', '2026-08-08 08:01:48'),
(406, 31, 31.5221572, 74.3590903, 15.00, 12.52, 18.00, '2026-08-08 08:01:52', '2026-08-08 08:01:52', '2026-08-08 08:01:52'),
(407, 31, 31.5219168, 74.3596692, 15.00, 32.58, 18.00, '2026-08-08 08:01:56', '2026-08-08 08:01:56', '2026-08-08 08:01:56'),
(408, 31, 31.5214925, 74.3601305, 15.00, 52.63, 18.00, '2026-08-08 08:02:00', '2026-08-08 08:02:00', '2026-08-08 08:02:00'),
(409, 31, 31.5209357, 74.3604184, 15.00, 72.68, 18.00, '2026-08-08 08:02:04', '2026-08-08 08:02:04', '2026-08-08 08:02:04');
INSERT INTO `trip_locations` (`id`, `trip_id`, `latitude`, `longitude`, `accuracy`, `heading`, `speed`, `recorded_at`, `created_at`, `updated_at`) VALUES
(410, 31, 31.5203140, 74.3604979, 15.00, 92.74, 18.00, '2026-08-08 08:02:08', '2026-08-08 08:02:08', '2026-08-08 08:02:08'),
(411, 31, 31.5197027, 74.3603595, 15.00, 112.79, 18.00, '2026-08-08 08:02:12', '2026-08-08 08:02:12', '2026-08-08 08:02:12'),
(412, 31, 31.5191760, 74.3600197, 15.00, 132.85, 18.00, '2026-08-08 08:02:16', '2026-08-08 08:02:16', '2026-08-08 08:02:16'),
(413, 31, 31.5187976, 74.3595200, 15.00, 152.90, 18.00, '2026-08-08 08:02:20', '2026-08-08 08:02:20', '2026-08-08 08:02:20'),
(414, 31, 31.5186136, 74.3589208, 15.00, 172.95, 18.00, '2026-08-08 08:02:24', '2026-08-08 08:02:24', '2026-08-08 08:02:24'),
(415, 31, 31.5186462, 74.3582949, 15.00, 193.01, 18.00, '2026-08-08 08:02:28', '2026-08-08 08:02:28', '2026-08-08 08:02:28'),
(416, 31, 31.5188914, 74.3577181, 15.00, 213.06, 18.00, '2026-08-08 08:02:33', '2026-08-08 08:02:33', '2026-08-08 08:02:33'),
(417, 31, 31.5193196, 74.3572603, 15.00, 233.11, 18.00, '2026-08-08 08:02:36', '2026-08-08 08:02:36', '2026-08-08 08:02:36'),
(418, 31, 31.5198787, 74.3569771, 15.00, 253.17, 18.00, '2026-08-08 08:02:40', '2026-08-08 08:02:40', '2026-08-08 08:02:40'),
(419, 31, 31.5205011, 74.3569028, 15.00, 273.22, 18.00, '2026-08-08 08:02:44', '2026-08-08 08:02:44', '2026-08-08 08:02:44'),
(420, 31, 31.5211112, 74.3570465, 15.00, 293.27, 18.00, '2026-08-08 08:02:48', '2026-08-08 08:02:48', '2026-08-08 08:02:48'),
(421, 31, 31.5216351, 74.3573906, 15.00, 313.33, 18.00, '2026-08-08 08:02:52', '2026-08-08 08:02:52', '2026-08-08 08:02:52'),
(422, 31, 31.5220092, 74.3578935, 15.00, 333.38, 18.00, '2026-08-08 08:02:56', '2026-08-08 08:02:56', '2026-08-08 08:02:56'),
(423, 31, 31.5221882, 74.3584942, 15.00, 353.43, 18.00, '2026-08-08 08:03:00', '2026-08-08 08:03:00', '2026-08-08 08:03:00'),
(424, 31, 31.5221504, 74.3591198, 15.00, 13.49, 18.00, '2026-08-08 08:03:04', '2026-08-08 08:03:04', '2026-08-08 08:03:04'),
(425, 31, 31.5219003, 74.3596946, 15.00, 33.54, 18.00, '2026-08-08 08:03:08', '2026-08-08 08:03:08', '2026-08-08 08:03:08'),
(426, 31, 31.5214683, 74.3601487, 15.00, 53.59, 18.00, '2026-08-08 08:03:12', '2026-08-08 08:03:12', '2026-08-08 08:03:12'),
(427, 31, 31.5209068, 74.3604272, 15.00, 73.65, 18.00, '2026-08-08 08:03:16', '2026-08-08 08:03:16', '2026-08-08 08:03:16'),
(428, 31, 31.5202838, 74.3604962, 15.00, 93.70, 18.00, '2026-08-08 08:03:20', '2026-08-08 08:03:20', '2026-08-08 08:03:20'),
(429, 31, 31.5196749, 74.3603475, 15.00, 113.76, 18.00, '2026-08-08 08:03:24', '2026-08-08 08:03:24', '2026-08-08 08:03:24'),
(430, 31, 31.5191539, 74.3599990, 15.00, 133.81, 18.00, '2026-08-08 08:03:28', '2026-08-08 08:03:28', '2026-08-08 08:03:28'),
(431, 31, 31.5187841, 74.3594930, 15.00, 153.86, 18.00, '2026-08-08 08:03:33', '2026-08-08 08:03:33', '2026-08-08 08:03:33'),
(432, 31, 31.5186101, 74.3588908, 15.00, 173.92, 18.00, '2026-08-08 08:03:36', '2026-08-08 08:03:36', '2026-08-08 08:03:36'),
(433, 31, 31.5186532, 74.3582655, 15.00, 193.97, 18.00, '2026-08-08 08:03:40', '2026-08-08 08:03:40', '2026-08-08 08:03:40'),
(434, 31, 31.5189081, 74.3576929, 15.00, 214.02, 18.00, '2026-08-08 08:03:44', '2026-08-08 08:03:44', '2026-08-08 08:03:44'),
(435, 31, 31.5193439, 74.3572424, 15.00, 234.08, 18.00, '2026-08-08 08:03:48', '2026-08-08 08:03:48', '2026-08-08 08:03:48'),
(436, 31, 31.5199078, 74.3569686, 15.00, 254.13, 18.00, '2026-08-08 08:03:52', '2026-08-08 08:03:52', '2026-08-08 08:03:52'),
(437, 31, 31.5205313, 74.3569048, 15.00, 274.18, 18.00, '2026-08-08 08:03:56', '2026-08-08 08:03:56', '2026-08-08 08:03:56'),
(438, 31, 31.5211389, 74.3570587, 15.00, 294.24, 18.00, '2026-08-08 08:04:00', '2026-08-08 08:04:00', '2026-08-08 08:04:00'),
(439, 31, 31.5216569, 74.3574115, 15.00, 314.29, 18.00, '2026-08-08 08:04:04', '2026-08-08 08:04:04', '2026-08-08 08:04:04'),
(440, 31, 31.5220225, 74.3579207, 15.00, 334.34, 18.00, '2026-08-08 08:04:08', '2026-08-08 08:04:08', '2026-08-08 08:04:08'),
(441, 31, 31.5221914, 74.3585243, 15.00, 354.40, 18.00, '2026-08-08 08:04:12', '2026-08-08 08:04:12', '2026-08-08 08:04:12'),
(442, 31, 31.5221430, 74.3591492, 15.00, 14.45, 18.00, '2026-08-08 08:04:16', '2026-08-08 08:04:16', '2026-08-08 08:04:16'),
(443, 31, 31.5218833, 74.3597197, 15.00, 34.50, 18.00, '2026-08-08 08:04:20', '2026-08-08 08:04:20', '2026-08-08 08:04:20'),
(444, 31, 31.5214438, 74.3601665, 15.00, 54.56, 18.00, '2026-08-08 08:04:24', '2026-08-08 08:04:24', '2026-08-08 08:04:24'),
(445, 31, 31.5208776, 74.3604355, 15.00, 74.61, 18.00, '2026-08-08 08:04:28', '2026-08-08 08:04:28', '2026-08-08 08:04:28'),
(446, 31, 31.5202536, 74.3604940, 15.00, 94.67, 18.00, '2026-08-08 08:04:32', '2026-08-08 08:04:32', '2026-08-08 08:04:32'),
(447, 31, 31.5196473, 74.3603351, 15.00, 114.72, 18.00, '2026-08-08 08:04:36', '2026-08-08 08:04:36', '2026-08-08 08:04:36'),
(448, 31, 31.5191323, 74.3599778, 15.00, 134.77, 18.00, '2026-08-08 08:04:40', '2026-08-08 08:04:40', '2026-08-08 08:04:40'),
(449, 31, 31.5187710, 74.3594657, 15.00, 154.83, 18.00, '2026-08-08 08:04:44', '2026-08-08 08:04:44', '2026-08-08 08:04:44'),
(450, 31, 31.5186072, 74.3588607, 15.00, 174.88, 18.00, '2026-08-08 08:04:48', '2026-08-08 08:04:48', '2026-08-08 08:04:48'),
(451, 31, 31.5186608, 74.3582362, 15.00, 194.93, 18.00, '2026-08-08 08:04:52', '2026-08-08 08:04:52', '2026-08-08 08:04:52'),
(452, 31, 31.5189253, 74.3576679, 15.00, 214.99, 18.00, '2026-08-08 08:04:56', '2026-08-08 08:04:56', '2026-08-08 08:04:56'),
(453, 31, 31.5193686, 74.3572248, 15.00, 235.04, 18.00, '2026-08-08 08:05:00', '2026-08-08 08:05:00', '2026-08-08 08:05:00'),
(454, 31, 31.5199370, 74.3569606, 15.00, 255.09, 18.00, '2026-08-08 08:05:04', '2026-08-08 08:05:04', '2026-08-08 08:05:04'),
(455, 31, 31.5205615, 74.3569073, 15.00, 275.15, 18.00, '2026-08-08 08:05:08', '2026-08-08 08:05:08', '2026-08-08 08:05:08'),
(456, 31, 31.5211664, 74.3570713, 15.00, 295.20, 18.00, '2026-08-08 08:05:12', '2026-08-08 08:05:12', '2026-08-08 08:05:12'),
(457, 31, 31.5216784, 74.3574329, 15.00, 315.25, 18.00, '2026-08-08 08:05:16', '2026-08-08 08:05:16', '2026-08-08 08:05:16'),
(458, 31, 31.5220354, 74.3579481, 15.00, 335.31, 18.00, '2026-08-08 08:05:20', '2026-08-08 08:05:20', '2026-08-08 08:05:20'),
(459, 31, 31.5221941, 74.3585544, 15.00, 355.36, 18.00, '2026-08-08 08:05:24', '2026-08-08 08:05:24', '2026-08-08 08:05:24'),
(460, 31, 31.5221353, 74.3591784, 15.00, 15.41, 18.00, '2026-08-08 08:05:28', '2026-08-08 08:05:28', '2026-08-08 08:05:28'),
(461, 31, 31.5218660, 74.3597444, 15.00, 35.47, 18.00, '2026-08-08 08:05:32', '2026-08-08 08:05:32', '2026-08-08 08:05:32'),
(462, 31, 31.5214190, 74.3601838, 15.00, 55.52, 18.00, '2026-08-08 08:05:36', '2026-08-08 08:05:36', '2026-08-08 08:05:36'),
(463, 31, 31.5208484, 74.3604433, 15.00, 75.58, 18.00, '2026-08-08 08:05:40', '2026-08-08 08:05:40', '2026-08-08 08:05:40'),
(464, 31, 31.5202235, 74.3604913, 15.00, 95.63, 18.00, '2026-08-08 08:05:44', '2026-08-08 08:05:44', '2026-08-08 08:05:44'),
(465, 31, 31.5196199, 74.3603222, 15.00, 115.68, 18.00, '2026-08-08 08:05:48', '2026-08-08 08:05:48', '2026-08-08 08:05:48'),
(466, 31, 31.5191110, 74.3599563, 15.00, 135.74, 18.00, '2026-08-08 08:05:52', '2026-08-08 08:05:52', '2026-08-08 08:05:52'),
(467, 31, 31.5187583, 74.3594382, 15.00, 155.79, 18.00, '2026-08-08 08:05:56', '2026-08-08 08:05:56', '2026-08-08 08:05:56'),
(468, 31, 31.5186047, 74.3588305, 15.00, 175.84, 18.00, '2026-08-08 08:06:00', '2026-08-08 08:06:00', '2026-08-08 08:06:00'),
(469, 31, 31.5186688, 74.3582070, 15.00, 195.90, 18.00, '2026-08-08 08:06:04', '2026-08-08 08:06:04', '2026-08-08 08:06:04'),
(470, 31, 31.5189428, 74.3576433, 15.00, 215.95, 18.00, '2026-08-08 08:06:08', '2026-08-08 08:06:08', '2026-08-08 08:06:08'),
(471, 31, 31.5193935, 74.3572077, 15.00, 236.00, 18.00, '2026-08-08 08:06:12', '2026-08-08 08:06:12', '2026-08-08 08:06:12'),
(472, 31, 31.5199663, 74.3569530, 15.00, 256.06, 18.00, '2026-08-08 08:06:16', '2026-08-08 08:06:16', '2026-08-08 08:06:16'),
(473, 31, 31.5205916, 74.3569102, 15.00, 276.11, 18.00, '2026-08-08 08:06:20', '2026-08-08 08:06:20', '2026-08-08 08:06:20'),
(474, 31, 31.5211937, 74.3570844, 15.00, 296.16, 18.00, '2026-08-08 08:06:24', '2026-08-08 08:06:24', '2026-08-08 08:06:24'),
(475, 31, 31.5216995, 74.3574545, 15.00, 316.22, 18.00, '2026-08-08 08:06:28', '2026-08-08 08:06:28', '2026-08-08 08:06:28'),
(476, 31, 31.5220478, 74.3579757, 15.00, 336.27, 18.00, '2026-08-08 08:06:32', '2026-08-08 08:06:32', '2026-08-08 08:06:32'),
(477, 31, 31.5221963, 74.3585846, 15.00, 356.32, 18.00, '2026-08-08 08:06:36', '2026-08-08 08:06:36', '2026-08-08 08:06:36'),
(478, 31, 31.5221270, 74.3592076, 15.00, 16.38, 18.00, '2026-08-08 08:06:40', '2026-08-08 08:06:40', '2026-08-08 08:06:40'),
(479, 31, 31.5218482, 74.3597690, 15.00, 36.43, 18.00, '2026-08-08 08:06:44', '2026-08-08 08:06:44', '2026-08-08 08:06:44'),
(480, 31, 31.5213939, 74.3602007, 15.00, 56.49, 18.00, '2026-08-08 08:06:48', '2026-08-08 08:06:48', '2026-08-08 08:06:48'),
(481, 31, 31.5208190, 74.3604505, 15.00, 76.54, 18.00, '2026-08-08 08:06:52', '2026-08-08 08:06:52', '2026-08-08 08:06:52'),
(482, 31, 31.5201934, 74.3604881, 15.00, 96.59, 18.00, '2026-08-08 08:06:56', '2026-08-08 08:06:56', '2026-08-08 08:06:56'),
(483, 31, 31.5195928, 74.3603088, 15.00, 116.65, 18.00, '2026-08-08 08:07:00', '2026-08-08 08:07:00', '2026-08-08 08:07:00'),
(484, 31, 31.5190900, 74.3599345, 15.00, 136.70, 18.00, '2026-08-08 08:07:04', '2026-08-08 08:07:04', '2026-08-08 08:07:04'),
(485, 31, 31.5187461, 74.3594105, 15.00, 156.75, 18.00, '2026-08-08 08:07:08', '2026-08-08 08:07:08', '2026-08-08 08:07:08'),
(486, 31, 31.5186028, 74.3588003, 15.00, 176.81, 18.00, '2026-08-08 08:07:12', '2026-08-08 08:07:12', '2026-08-08 08:07:12'),
(487, 31, 31.5186774, 74.3581779, 15.00, 196.86, 18.00, '2026-08-08 08:07:16', '2026-08-08 08:07:16', '2026-08-08 08:07:16'),
(488, 31, 31.5189608, 74.3576189, 15.00, 216.91, 18.00, '2026-08-08 08:07:20', '2026-08-08 08:07:20', '2026-08-08 08:07:20'),
(489, 31, 31.5194188, 74.3571910, 15.00, 236.97, 18.00, '2026-08-08 08:07:24', '2026-08-08 08:07:24', '2026-08-08 08:07:24'),
(490, 31, 31.5199957, 74.3569460, 15.00, 257.02, 18.00, '2026-08-08 08:07:28', '2026-08-08 08:07:28', '2026-08-08 08:07:28'),
(491, 31, 31.5206217, 74.3569137, 15.00, 277.07, 18.00, '2026-08-08 08:07:32', '2026-08-08 08:07:32', '2026-08-08 08:07:32'),
(492, 31, 31.5212207, 74.3570980, 15.00, 297.13, 18.00, '2026-08-08 08:07:36', '2026-08-08 08:07:36', '2026-08-08 08:07:36'),
(493, 31, 31.5217203, 74.3574766, 15.00, 317.18, 18.00, '2026-08-08 08:07:40', '2026-08-08 08:07:40', '2026-08-08 08:07:40'),
(494, 31, 31.5220598, 74.3580035, 15.00, 337.23, 18.00, '2026-08-08 08:07:44', '2026-08-08 08:07:44', '2026-08-08 08:07:44'),
(495, 31, 31.5221980, 74.3586148, 15.00, 357.29, 18.00, '2026-08-08 08:07:48', '2026-08-08 08:07:48', '2026-08-08 08:07:48'),
(496, 31, 31.5221182, 74.3592365, 15.00, 17.34, 18.00, '2026-08-08 08:07:52', '2026-08-08 08:07:52', '2026-08-08 08:07:52'),
(497, 31, 31.5218300, 74.3597931, 15.00, 37.39, 18.00, '2026-08-08 08:07:56', '2026-08-08 08:07:56', '2026-08-08 08:07:56'),
(498, 31, 31.5213685, 74.3602172, 15.00, 57.45, 18.00, '2026-08-08 08:08:00', '2026-08-08 08:08:00', '2026-08-08 08:08:00'),
(499, 31, 31.5207895, 74.3604573, 15.00, 77.50, 18.00, '2026-08-08 08:08:04', '2026-08-08 08:08:04', '2026-08-08 08:08:04'),
(500, 31, 31.5201633, 74.3604844, 15.00, 97.56, 18.00, '2026-08-08 08:08:08', '2026-08-08 08:08:08', '2026-08-08 08:08:08'),
(501, 31, 31.5195658, 74.3602950, 15.00, 117.61, 18.00, '2026-08-08 08:08:12', '2026-08-08 08:08:12', '2026-08-08 08:08:12'),
(502, 31, 31.5190695, 74.3599123, 15.00, 137.66, 18.00, '2026-08-08 08:08:16', '2026-08-08 08:08:16', '2026-08-08 08:08:16'),
(503, 31, 31.5187344, 74.3593826, 15.00, 157.72, 18.00, '2026-08-08 08:08:20', '2026-08-08 08:08:20', '2026-08-08 08:08:20'),
(504, 31, 31.5186014, 74.3587701, 15.00, 177.77, 18.00, '2026-08-08 08:08:24', '2026-08-08 08:08:24', '2026-08-08 08:08:24'),
(505, 31, 31.5186864, 74.3581491, 15.00, 197.82, 18.00, '2026-08-08 08:08:28', '2026-08-08 08:08:28', '2026-08-08 08:08:28'),
(506, 31, 31.5189792, 74.3575949, 15.00, 217.88, 18.00, '2026-08-08 08:08:32', '2026-08-08 08:08:32', '2026-08-08 08:08:32'),
(507, 31, 31.5194443, 74.3571747, 15.00, 237.93, 18.00, '2026-08-08 08:08:36', '2026-08-08 08:08:36', '2026-08-08 08:08:36'),
(508, 31, 31.5200253, 74.3569394, 15.00, 257.98, 18.00, '2026-08-08 08:08:40', '2026-08-08 08:08:40', '2026-08-08 08:08:40'),
(509, 31, 31.5206517, 74.3569177, 15.00, 278.04, 18.00, '2026-08-08 08:08:44', '2026-08-08 08:08:44', '2026-08-08 08:08:44'),
(510, 31, 31.5212476, 74.3571120, 15.00, 298.09, 18.00, '2026-08-08 08:08:48', '2026-08-08 08:08:48', '2026-08-08 08:08:48'),
(511, 31, 31.5217407, 74.3574989, 15.00, 318.14, 18.00, '2026-08-08 08:08:52', '2026-08-08 08:08:52', '2026-08-08 08:08:52'),
(512, 31, 31.5220712, 74.3580315, 15.00, 338.20, 18.00, '2026-08-08 08:08:56', '2026-08-08 08:08:56', '2026-08-08 08:08:56'),
(513, 31, 31.5221992, 74.3586451, 15.00, 358.25, 18.00, '2026-08-08 08:09:00', '2026-08-08 08:09:00', '2026-08-08 08:09:00'),
(514, 31, 31.5221089, 74.3592653, 15.00, 18.30, 18.00, '2026-08-08 08:09:04', '2026-08-08 08:09:04', '2026-08-08 08:09:04'),
(515, 31, 31.5218115, 74.3598170, 15.00, 38.36, 18.00, '2026-08-08 08:09:08', '2026-08-08 08:09:08', '2026-08-08 08:09:08'),
(516, 31, 31.5213429, 74.3602333, 15.00, 58.41, 18.00, '2026-08-08 08:09:12', '2026-08-08 08:09:12', '2026-08-08 08:09:12'),
(517, 31, 31.5207599, 74.3604636, 15.00, 78.47, 18.00, '2026-08-08 08:09:16', '2026-08-08 08:09:16', '2026-08-08 08:09:16'),
(518, 31, 31.5201334, 74.3604801, 15.00, 98.52, 18.00, '2026-08-08 08:09:20', '2026-08-08 08:09:20', '2026-08-08 08:09:20'),
(519, 31, 31.5195391, 74.3602808, 15.00, 118.57, 18.00, '2026-08-08 08:09:24', '2026-08-08 08:09:24', '2026-08-08 08:09:24'),
(520, 31, 31.5190493, 74.3598897, 15.00, 138.63, 18.00, '2026-08-08 08:09:28', '2026-08-08 08:09:28', '2026-08-08 08:09:28'),
(521, 31, 31.5187232, 74.3593545, 15.00, 158.68, 18.00, '2026-08-08 08:09:33', '2026-08-08 08:09:33', '2026-08-08 08:09:33'),
(522, 31, 31.5186004, 74.3587398, 15.00, 178.73, 18.00, '2026-08-08 08:09:36', '2026-08-08 08:09:36', '2026-08-08 08:09:36'),
(523, 31, 31.5186959, 74.3581203, 15.00, 198.79, 18.00, '2026-08-08 08:09:40', '2026-08-08 08:09:40', '2026-08-08 08:09:40'),
(524, 31, 31.5189980, 74.3575711, 15.00, 218.84, 18.00, '2026-08-08 08:09:44', '2026-08-08 08:09:44', '2026-08-08 08:09:44'),
(525, 31, 31.5194701, 74.3571588, 15.00, 238.89, 18.00, '2026-08-08 08:09:48', '2026-08-08 08:09:48', '2026-08-08 08:09:48'),
(526, 31, 31.5200549, 74.3569334, 15.00, 258.95, 18.00, '2026-08-08 08:09:52', '2026-08-08 08:09:52', '2026-08-08 08:09:52'),
(527, 31, 31.5206816, 74.3569222, 15.00, 279.00, 18.00, '2026-08-08 08:09:57', '2026-08-08 08:09:57', '2026-08-08 08:09:57'),
(528, 31, 31.5212741, 74.3571265, 15.00, 299.05, 18.00, '2026-08-08 08:10:01', '2026-08-08 08:10:01', '2026-08-08 08:10:01'),
(529, 31, 31.5217607, 74.3575216, 15.00, 319.11, 18.00, '2026-08-08 08:10:05', '2026-08-08 08:10:05', '2026-08-08 08:10:05'),
(530, 31, 31.5220823, 74.3580597, 15.00, 339.16, 18.00, '2026-08-08 08:10:08', '2026-08-08 08:10:08', '2026-08-08 08:10:08'),
(531, 31, 31.5221998, 74.3586753, 15.00, 359.21, 18.00, '2026-08-08 08:10:12', '2026-08-08 08:10:13', '2026-08-08 08:10:13'),
(532, 31, 31.5220992, 74.3592940, 15.00, 19.27, 18.00, '2026-08-08 08:10:17', '2026-08-08 08:10:17', '2026-08-08 08:10:17'),
(533, 31, 31.5217925, 74.3598406, 15.00, 39.32, 18.00, '2026-08-08 08:10:21', '2026-08-08 08:10:21', '2026-08-08 08:10:21'),
(534, 31, 31.5213169, 74.3602489, 15.00, 59.38, 18.00, '2026-08-08 08:10:25', '2026-08-08 08:10:25', '2026-08-08 08:10:25'),
(535, 31, 31.5207302, 74.3604694, 15.00, 79.43, 18.00, '2026-08-08 08:10:29', '2026-08-08 08:10:29', '2026-08-08 08:10:29'),
(536, 31, 31.5201035, 74.3604754, 15.00, 99.48, 18.00, '2026-08-08 08:10:33', '2026-08-08 08:10:33', '2026-08-08 08:10:33'),
(537, 31, 31.5195127, 74.3602661, 15.00, 119.54, 18.00, '2026-08-08 08:10:37', '2026-08-08 08:10:37', '2026-08-08 08:10:37'),
(538, 31, 31.5190294, 74.3598669, 15.00, 139.59, 18.00, '2026-08-08 08:10:41', '2026-08-08 08:10:41', '2026-08-08 08:10:41'),
(539, 31, 31.5187124, 74.3593262, 15.00, 159.64, 18.00, '2026-08-08 08:10:45', '2026-08-08 08:10:45', '2026-08-08 08:10:45'),
(540, 31, 31.5186000, 74.3587095, 15.00, 179.70, 18.00, '2026-08-08 08:10:49', '2026-08-08 08:10:49', '2026-08-08 08:10:49'),
(541, 31, 31.5187059, 74.3580918, 15.00, 199.75, 18.00, '2026-08-08 08:10:53', '2026-08-08 08:10:53', '2026-08-08 08:10:53'),
(542, 31, 31.5190172, 74.3575477, 15.00, 219.80, 18.00, '2026-08-08 08:10:57', '2026-08-08 08:10:57', '2026-08-08 08:10:57'),
(543, 31, 31.5194961, 74.3571434, 15.00, 239.86, 18.00, '2026-08-08 08:11:01', '2026-08-08 08:11:01', '2026-08-08 08:11:01'),
(544, 31, 31.5200847, 74.3569278, 15.00, 259.91, 18.00, '2026-08-08 08:11:05', '2026-08-08 08:11:05', '2026-08-08 08:11:05'),
(545, 31, 31.5207115, 74.3569272, 15.00, 279.96, 18.00, '2026-08-08 08:11:09', '2026-08-08 08:11:09', '2026-08-08 08:11:09'),
(546, 31, 31.5213005, 74.3571414, 15.00, 300.02, 18.00, '2026-08-08 08:11:13', '2026-08-08 08:11:13', '2026-08-08 08:11:13'),
(547, 31, 31.5217803, 74.3575447, 15.00, 320.07, 18.00, '2026-08-08 08:11:17', '2026-08-08 08:11:17', '2026-08-08 08:11:17'),
(548, 31, 31.5220928, 74.3580880, 15.00, 340.12, 18.00, '2026-08-08 08:11:21', '2026-08-08 08:11:21', '2026-08-08 08:11:21'),
(549, 31, 31.5222000, 74.3587056, 15.00, 0.18, 18.00, '2026-08-08 08:11:25', '2026-08-08 08:11:25', '2026-08-08 08:11:25'),
(550, 31, 31.5220889, 74.3593225, 15.00, 20.23, 18.00, '2026-08-08 08:11:29', '2026-08-08 08:11:29', '2026-08-08 08:11:29'),
(551, 31, 31.5217731, 74.3598639, 15.00, 40.29, 18.00, '2026-08-08 08:11:33', '2026-08-08 08:11:33', '2026-08-08 08:11:33'),
(552, 31, 31.5212908, 74.3602641, 15.00, 60.34, 18.00, '2026-08-08 08:11:37', '2026-08-08 08:11:37', '2026-08-08 08:11:37'),
(553, 31, 31.5207004, 74.3604748, 15.00, 80.39, 18.00, '2026-08-08 08:11:41', '2026-08-08 08:11:41', '2026-08-08 08:11:41'),
(554, 31, 31.5200737, 74.3604702, 15.00, 100.45, 18.00, '2026-08-08 08:11:45', '2026-08-08 08:11:45', '2026-08-08 08:11:45'),
(555, 31, 31.5194865, 74.3602509, 15.00, 120.50, 18.00, '2026-08-08 08:11:49', '2026-08-08 08:11:49', '2026-08-08 08:11:49'),
(556, 31, 31.5190100, 74.3598437, 15.00, 140.55, 18.00, '2026-08-08 08:11:53', '2026-08-08 08:11:53', '2026-08-08 08:11:53'),
(557, 31, 31.5187021, 74.3592977, 15.00, 160.61, 18.00, '2026-08-08 08:11:57', '2026-08-08 08:11:57', '2026-08-08 08:11:57'),
(558, 31, 31.5186001, 74.3586793, 15.00, 180.66, 18.00, '2026-08-08 08:12:01', '2026-08-08 08:12:01', '2026-08-08 08:12:01'),
(559, 31, 31.5187163, 74.3580634, 15.00, 200.71, 18.00, '2026-08-08 08:12:05', '2026-08-08 08:12:05', '2026-08-08 08:12:05'),
(560, 31, 31.5190367, 74.3575246, 15.00, 220.77, 18.00, '2026-08-08 08:12:09', '2026-08-08 08:12:09', '2026-08-08 08:12:09'),
(561, 31, 31.5195224, 74.3571284, 15.00, 240.82, 18.00, '2026-08-08 08:12:13', '2026-08-08 08:12:13', '2026-08-08 08:12:13'),
(562, 31, 31.5201145, 74.3569228, 15.00, 260.87, 18.00, '2026-08-08 08:12:17', '2026-08-08 08:12:17', '2026-08-08 08:12:17'),
(563, 31, 31.5207412, 74.3569326, 15.00, 280.93, 18.00, '2026-08-08 08:12:21', '2026-08-08 08:12:21', '2026-08-08 08:12:21'),
(564, 31, 31.5213266, 74.3571568, 15.00, 300.98, 18.00, '2026-08-08 08:12:25', '2026-08-08 08:12:25', '2026-08-08 08:12:25'),
(565, 31, 31.5217995, 74.3575681, 15.00, 321.03, 18.00, '2026-08-08 08:12:29', '2026-08-08 08:12:29', '2026-08-08 08:12:29'),
(566, 31, 31.5221028, 74.3581166, 15.00, 341.09, 18.00, '2026-08-08 08:12:33', '2026-08-08 08:12:33', '2026-08-08 08:12:33'),
(567, 31, 31.5221996, 74.3587359, 15.00, 1.14, 18.00, '2026-08-08 08:12:37', '2026-08-08 08:12:37', '2026-08-08 08:12:37'),
(568, 31, 31.5220782, 74.3593508, 15.00, 21.20, 18.00, '2026-08-08 08:12:41', '2026-08-08 08:12:41', '2026-08-08 08:12:41'),
(569, 31, 31.5217533, 74.3598868, 15.00, 41.25, 18.00, '2026-08-08 08:12:45', '2026-08-08 08:12:45', '2026-08-08 08:12:45'),
(570, 31, 31.5212643, 74.3602789, 15.00, 61.30, 18.00, '2026-08-08 08:12:49', '2026-08-08 08:12:49', '2026-08-08 08:12:49'),
(571, 31, 31.5206705, 74.3604796, 15.00, 81.36, 18.00, '2026-08-08 08:12:53', '2026-08-08 08:12:53', '2026-08-08 08:12:53'),
(572, 31, 31.5200439, 74.3604644, 15.00, 101.41, 18.00, '2026-08-08 08:12:57', '2026-08-08 08:12:57', '2026-08-08 08:12:57'),
(573, 31, 31.5194605, 74.3602354, 15.00, 121.46, 18.00, '2026-08-08 08:13:01', '2026-08-08 08:13:01', '2026-08-08 08:13:01'),
(574, 31, 31.5189910, 74.3598201, 15.00, 141.52, 18.00, '2026-08-08 08:13:05', '2026-08-08 08:13:05', '2026-08-08 08:13:05'),
(575, 31, 31.5186923, 74.3592691, 15.00, 161.57, 18.00, '2026-08-08 08:13:09', '2026-08-08 08:13:09', '2026-08-08 08:13:09'),
(576, 31, 31.5186007, 74.3586490, 15.00, 181.62, 18.00, '2026-08-08 08:13:13', '2026-08-08 08:13:13', '2026-08-08 08:13:13'),
(577, 31, 31.5187273, 74.3580351, 15.00, 201.68, 18.00, '2026-08-08 08:13:17', '2026-08-08 08:13:17', '2026-08-08 08:13:17'),
(578, 31, 31.5190567, 74.3575019, 15.00, 221.73, 18.00, '2026-08-08 08:13:21', '2026-08-08 08:13:21', '2026-08-08 08:13:21'),
(579, 31, 31.5195490, 74.3571139, 15.00, 241.78, 18.00, '2026-08-08 08:13:25', '2026-08-08 08:13:25', '2026-08-08 08:13:25'),
(580, 31, 31.5201444, 74.3569182, 15.00, 261.84, 18.00, '2026-08-08 08:13:29', '2026-08-08 08:13:29', '2026-08-08 08:13:29'),
(581, 31, 31.5207709, 74.3569386, 15.00, 281.89, 18.00, '2026-08-08 08:13:33', '2026-08-08 08:13:33', '2026-08-08 08:13:33'),
(582, 31, 31.5213524, 74.3571726, 15.00, 301.94, 18.00, '2026-08-08 08:13:37', '2026-08-08 08:13:37', '2026-08-08 08:13:37'),
(583, 31, 31.5218184, 74.3575918, 15.00, 322.00, 18.00, '2026-08-08 08:13:41', '2026-08-08 08:13:41', '2026-08-08 08:13:41'),
(584, 31, 31.5221124, 74.3581453, 15.00, 342.05, 18.00, '2026-08-08 08:13:45', '2026-08-08 08:13:45', '2026-08-08 08:13:45'),
(585, 31, 31.5221988, 74.3587661, 15.00, 2.10, 18.00, '2026-08-08 08:13:49', '2026-08-08 08:13:49', '2026-08-08 08:13:49'),
(586, 31, 31.5220671, 74.3593789, 15.00, 22.16, 18.00, '2026-08-08 08:13:53', '2026-08-08 08:13:53', '2026-08-08 08:13:53'),
(587, 31, 31.5217332, 74.3599094, 15.00, 42.21, 18.00, '2026-08-08 08:13:57', '2026-08-08 08:13:57', '2026-08-08 08:13:57'),
(588, 31, 31.5212377, 74.3602932, 15.00, 62.27, 18.00, '2026-08-08 08:14:01', '2026-08-08 08:14:01', '2026-08-08 08:14:01'),
(589, 31, 31.5206406, 74.3604838, 15.00, 82.32, 18.00, '2026-08-08 08:14:05', '2026-08-08 08:14:05', '2026-08-08 08:14:05'),
(590, 31, 31.5200143, 74.3604582, 15.00, 102.37, 18.00, '2026-08-08 08:14:09', '2026-08-08 08:14:09', '2026-08-08 08:14:09'),
(591, 31, 31.5194348, 74.3602194, 15.00, 122.43, 18.00, '2026-08-08 08:14:13', '2026-08-08 08:14:13', '2026-08-08 08:14:13'),
(592, 31, 31.5189724, 74.3597963, 15.00, 142.48, 18.00, '2026-08-08 08:14:17', '2026-08-08 08:14:17', '2026-08-08 08:14:17'),
(593, 31, 31.5186830, 74.3592403, 15.00, 162.53, 18.00, '2026-08-08 08:14:21', '2026-08-08 08:14:21', '2026-08-08 08:14:21'),
(594, 31, 31.5186018, 74.3586188, 15.00, 182.59, 18.00, '2026-08-08 08:14:25', '2026-08-08 08:14:25', '2026-08-08 08:14:25'),
(595, 31, 31.5187387, 74.3580071, 15.00, 202.64, 18.00, '2026-08-08 08:14:29', '2026-08-08 08:14:29', '2026-08-08 08:14:29'),
(596, 31, 31.5190770, 74.3574795, 15.00, 222.69, 18.00, '2026-08-08 08:14:33', '2026-08-08 08:14:33', '2026-08-08 08:14:33'),
(597, 31, 31.5195757, 74.3570998, 15.00, 242.75, 18.00, '2026-08-08 08:14:37', '2026-08-08 08:14:37', '2026-08-08 08:14:37'),
(598, 31, 31.5201744, 74.3569142, 15.00, 262.80, 18.00, '2026-08-08 08:14:41', '2026-08-08 08:14:41', '2026-08-08 08:14:41'),
(599, 31, 31.5208004, 74.3569451, 15.00, 282.85, 18.00, '2026-08-08 08:14:45', '2026-08-08 08:14:45', '2026-08-08 08:14:45'),
(600, 31, 31.5213779, 74.3571888, 15.00, 302.91, 18.00, '2026-08-08 08:14:49', '2026-08-08 08:14:49', '2026-08-08 08:14:49'),
(601, 31, 31.5218368, 74.3576158, 15.00, 322.96, 18.00, '2026-08-08 08:14:53', '2026-08-08 08:14:53', '2026-08-08 08:14:53'),
(602, 31, 31.5221215, 74.3581742, 15.00, 343.01, 18.00, '2026-08-08 08:14:57', '2026-08-08 08:14:57', '2026-08-08 08:14:57'),
(603, 31, 31.5221974, 74.3587963, 15.00, 3.07, 18.00, '2026-08-08 08:15:01', '2026-08-08 08:15:01', '2026-08-08 08:15:01'),
(604, 31, 31.5220554, 74.3594068, 15.00, 23.12, 18.00, '2026-08-08 08:15:05', '2026-08-08 08:15:05', '2026-08-08 08:15:05'),
(605, 31, 31.5217127, 74.3599316, 15.00, 43.18, 18.00, '2026-08-08 08:15:09', '2026-08-08 08:15:09', '2026-08-08 08:15:09'),
(606, 31, 31.5212108, 74.3603071, 15.00, 63.23, 18.00, '2026-08-08 08:15:13', '2026-08-08 08:15:13', '2026-08-08 08:15:13'),
(607, 31, 31.5206106, 74.3604876, 15.00, 83.28, 18.00, '2026-08-08 08:15:17', '2026-08-08 08:15:17', '2026-08-08 08:15:17'),
(608, 31, 31.5199848, 74.3604515, 15.00, 103.34, 18.00, '2026-08-08 08:15:21', '2026-08-08 08:15:21', '2026-08-08 08:15:21'),
(609, 31, 31.5194094, 74.3602029, 15.00, 123.39, 18.00, '2026-08-08 08:15:25', '2026-08-08 08:15:25', '2026-08-08 08:15:25'),
(610, 31, 31.5189541, 74.3597721, 15.00, 143.44, 18.00, '2026-08-08 08:15:29', '2026-08-08 08:15:29', '2026-08-08 08:15:29'),
(611, 31, 31.5186742, 74.3592113, 15.00, 163.50, 18.00, '2026-08-08 08:15:33', '2026-08-08 08:15:33', '2026-08-08 08:15:33'),
(612, 31, 31.5186035, 74.3585885, 15.00, 183.55, 18.00, '2026-08-08 08:15:37', '2026-08-08 08:15:37', '2026-08-08 08:15:37'),
(613, 31, 31.5187506, 74.3579793, 15.00, 203.60, 18.00, '2026-08-08 08:15:41', '2026-08-08 08:15:41', '2026-08-08 08:15:41'),
(614, 31, 31.5190977, 74.3574574, 15.00, 223.66, 18.00, '2026-08-08 08:15:45', '2026-08-08 08:15:45', '2026-08-08 08:15:45'),
(615, 31, 31.5196028, 74.3570862, 15.00, 243.71, 18.00, '2026-08-08 08:15:49', '2026-08-08 08:15:49', '2026-08-08 08:15:49'),
(616, 31, 31.5202045, 74.3569107, 15.00, 263.76, 18.00, '2026-08-08 08:15:52', '2026-08-08 08:15:52', '2026-08-08 08:15:52'),
(617, 31, 31.5208299, 74.3569521, 15.00, 283.82, 18.00, '2026-08-08 08:15:57', '2026-08-08 08:15:57', '2026-08-08 08:15:57'),
(618, 31, 31.5214032, 74.3572055, 15.00, 303.87, 18.00, '2026-08-08 08:16:01', '2026-08-08 08:16:01', '2026-08-08 08:16:01'),
(619, 31, 31.5218548, 74.3576401, 15.00, 323.92, 18.00, '2026-08-08 08:16:05', '2026-08-08 08:16:05', '2026-08-08 08:16:05'),
(620, 31, 31.5221301, 74.3582032, 15.00, 343.98, 18.00, '2026-08-08 08:16:09', '2026-08-08 08:16:09', '2026-08-08 08:16:09'),
(621, 31, 31.5221955, 74.3588266, 15.00, 4.03, 18.00, '2026-08-08 08:16:13', '2026-08-08 08:16:13', '2026-08-08 08:16:13'),
(622, 31, 31.5220433, 74.3594346, 15.00, 24.09, 18.00, '2026-08-08 08:16:17', '2026-08-08 08:16:17', '2026-08-08 08:16:17'),
(623, 31, 31.5216918, 74.3599535, 15.00, 44.14, 18.00, '2026-08-08 08:16:21', '2026-08-08 08:16:21', '2026-08-08 08:16:21'),
(624, 31, 31.5211836, 74.3603205, 15.00, 64.19, 18.00, '2026-08-08 08:16:25', '2026-08-08 08:16:25', '2026-08-08 08:16:25'),
(625, 31, 31.5205805, 74.3604909, 15.00, 84.25, 18.00, '2026-08-08 08:16:29', '2026-08-08 08:16:29', '2026-08-08 08:16:29'),
(626, 31, 31.5199554, 74.3604442, 15.00, 104.30, 18.00, '2026-08-08 08:16:33', '2026-08-08 08:16:33', '2026-08-08 08:16:33'),
(627, 31, 31.5193843, 74.3601860, 15.00, 124.35, 18.00, '2026-08-08 08:16:37', '2026-08-08 08:16:37', '2026-08-08 08:16:37'),
(628, 31, 31.5189363, 74.3597477, 15.00, 144.41, 18.00, '2026-08-08 08:16:41', '2026-08-08 08:16:41', '2026-08-08 08:16:41'),
(629, 31, 31.5186658, 74.3591822, 15.00, 164.46, 18.00, '2026-08-08 08:16:45', '2026-08-08 08:16:45', '2026-08-08 08:16:45'),
(630, 31, 31.5186056, 74.3585584, 15.00, 184.51, 18.00, '2026-08-08 08:16:49', '2026-08-08 08:16:49', '2026-08-08 08:16:49'),
(631, 31, 31.5187629, 74.3579516, 15.00, 204.57, 18.00, '2026-08-08 08:16:53', '2026-08-08 08:16:53', '2026-08-08 08:16:53'),
(632, 31, 31.5191188, 74.3574357, 15.00, 224.62, 18.00, '2026-08-08 08:16:57', '2026-08-08 08:16:57', '2026-08-08 08:16:57'),
(633, 31, 31.5196300, 74.3570730, 15.00, 244.67, 18.00, '2026-08-08 08:17:01', '2026-08-08 08:17:01', '2026-08-08 08:17:01'),
(634, 31, 31.5202346, 74.3569076, 15.00, 264.73, 18.00, '2026-08-08 08:17:05', '2026-08-08 08:17:05', '2026-08-08 08:17:05'),
(635, 31, 31.5208592, 74.3569596, 15.00, 284.78, 18.00, '2026-08-08 08:17:09', '2026-08-08 08:17:09', '2026-08-08 08:17:09'),
(636, 31, 31.5214282, 74.3572226, 15.00, 304.83, 18.00, '2026-08-08 08:17:13', '2026-08-08 08:17:13', '2026-08-08 08:17:13'),
(637, 31, 31.5218725, 74.3576647, 15.00, 324.89, 18.00, '2026-08-08 08:17:17', '2026-08-08 08:17:17', '2026-08-08 08:17:17'),
(638, 31, 31.5221382, 74.3582324, 15.00, 344.94, 18.00, '2026-08-08 08:17:21', '2026-08-08 08:17:21', '2026-08-08 08:17:21'),
(639, 31, 31.5221932, 74.3588567, 15.00, 5.00, 18.00, '2026-08-08 08:17:25', '2026-08-08 08:17:25', '2026-08-08 08:17:25'),
(640, 31, 31.5220307, 74.3594621, 15.00, 25.05, 18.00, '2026-08-08 08:17:29', '2026-08-08 08:17:29', '2026-08-08 08:17:29'),
(641, 31, 31.5216705, 74.3599751, 15.00, 45.10, 18.00, '2026-08-08 08:17:35', '2026-08-08 08:17:35', '2026-08-08 08:17:35'),
(642, 31, 31.5211563, 74.3603334, 15.00, 65.16, 18.00, '2026-08-08 08:17:37', '2026-08-08 08:17:37', '2026-08-08 08:17:37'),
(643, 31, 31.5205503, 74.3604937, 15.00, 85.21, 18.00, '2026-08-08 08:17:41', '2026-08-08 08:17:41', '2026-08-08 08:17:41'),
(644, 31, 31.5199262, 74.3604365, 15.00, 105.26, 18.00, '2026-08-08 08:17:45', '2026-08-08 08:17:45', '2026-08-08 08:17:45'),
(645, 31, 31.5193594, 74.3601688, 15.00, 125.32, 18.00, '2026-08-08 08:17:49', '2026-08-08 08:17:49', '2026-08-08 08:17:49'),
(646, 31, 31.5189189, 74.3597229, 15.00, 145.37, 18.00, '2026-08-08 08:17:53', '2026-08-08 08:17:53', '2026-08-08 08:17:53'),
(647, 31, 31.5186579, 74.3591530, 15.00, 165.42, 18.00, '2026-08-08 08:17:56', '2026-08-08 08:17:56', '2026-08-08 08:17:56'),
(648, 31, 31.5186082, 74.3585282, 15.00, 185.48, 18.00, '2026-08-08 08:18:02', '2026-08-08 08:18:02', '2026-08-08 08:18:02'),
(649, 31, 31.5187758, 74.3579242, 15.00, 205.53, 18.00, '2026-08-08 08:18:05', '2026-08-08 08:18:05', '2026-08-08 08:18:05'),
(650, 31, 31.5191402, 74.3574143, 15.00, 225.58, 18.00, '2026-08-08 08:18:09', '2026-08-08 08:18:09', '2026-08-08 08:18:09'),
(651, 31, 31.5196575, 74.3570603, 15.00, 245.64, 18.00, '2026-08-08 08:18:13', '2026-08-08 08:18:13', '2026-08-08 08:18:13'),
(652, 31, 31.5202648, 74.3569051, 15.00, 265.69, 18.00, '2026-08-08 08:18:17', '2026-08-08 08:18:17', '2026-08-08 08:18:17'),
(653, 31, 31.5208884, 74.3569675, 15.00, 285.74, 18.00, '2026-08-08 08:18:21', '2026-08-08 08:18:21', '2026-08-08 08:18:21'),
(654, 31, 31.5214529, 74.3572400, 15.00, 305.80, 18.00, '2026-08-08 08:18:25', '2026-08-08 08:18:25', '2026-08-08 08:18:25'),
(655, 31, 31.5218897, 74.3576896, 15.00, 325.85, 18.00, '2026-08-08 08:18:29', '2026-08-08 08:18:29', '2026-08-08 08:18:29'),
(656, 31, 31.5221458, 74.3582616, 15.00, 345.91, 18.00, '2026-08-08 08:18:33', '2026-08-08 08:18:33', '2026-08-08 08:18:33'),
(657, 31, 31.5221903, 74.3588869, 15.00, 5.96, 18.00, '2026-08-08 08:18:37', '2026-08-08 08:18:37', '2026-08-08 08:18:37'),
(658, 31, 31.5220177, 74.3594894, 15.00, 26.01, 18.00, '2026-08-08 08:18:41', '2026-08-08 08:18:41', '2026-08-08 08:18:41'),
(659, 31, 31.5216489, 74.3599962, 15.00, 46.07, 18.00, '2026-08-08 08:18:45', '2026-08-08 08:18:45', '2026-08-08 08:18:45'),
(660, 31, 31.5211287, 74.3603459, 15.00, 66.12, 18.00, '2026-08-08 08:18:49', '2026-08-08 08:18:49', '2026-08-08 08:18:49'),
(661, 31, 31.5205201, 74.3604960, 15.00, 86.17, 18.00, '2026-08-08 08:18:53', '2026-08-08 08:18:53', '2026-08-08 08:18:53'),
(662, 31, 31.5198970, 74.3604283, 15.00, 106.23, 18.00, '2026-08-08 08:18:57', '2026-08-08 08:18:57', '2026-08-08 08:18:57'),
(663, 31, 31.5193349, 74.3601510, 15.00, 126.28, 18.00, '2026-08-08 08:19:01', '2026-08-08 08:19:01', '2026-08-08 08:19:01'),
(664, 31, 31.5189019, 74.3596979, 15.00, 146.33, 18.00, '2026-08-08 08:19:05', '2026-08-08 08:19:05', '2026-08-08 08:19:05'),
(665, 31, 31.5186506, 74.3591237, 15.00, 166.39, 18.00, '2026-08-08 08:19:09', '2026-08-08 08:19:09', '2026-08-08 08:19:09'),
(666, 31, 31.5186114, 74.3584981, 15.00, 186.44, 18.00, '2026-08-08 08:19:13', '2026-08-08 08:19:13', '2026-08-08 08:19:13'),
(667, 31, 31.5187890, 74.3578970, 15.00, 206.49, 18.00, '2026-08-08 08:19:17', '2026-08-08 08:19:17', '2026-08-08 08:19:17'),
(668, 31, 31.5191620, 74.3573933, 15.00, 226.55, 18.00, '2026-08-08 08:19:21', '2026-08-08 08:19:21', '2026-08-08 08:19:21'),
(669, 31, 31.5196852, 74.3570480, 15.00, 246.60, 18.00, '2026-08-08 08:19:25', '2026-08-08 08:19:25', '2026-08-08 08:19:25'),
(670, 31, 31.5202950, 74.3569031, 15.00, 266.65, 18.00, '2026-08-08 08:19:29', '2026-08-08 08:19:29', '2026-08-08 08:19:29'),
(671, 31, 31.5209175, 74.3569760, 15.00, 286.71, 18.00, '2026-08-08 08:19:33', '2026-08-08 08:19:33', '2026-08-08 08:19:33'),
(672, 31, 31.5214773, 74.3572580, 15.00, 306.76, 18.00, '2026-08-08 08:19:37', '2026-08-08 08:19:37', '2026-08-08 08:19:37'),
(673, 31, 31.5219064, 74.3577148, 15.00, 326.81, 18.00, '2026-08-08 08:19:41', '2026-08-08 08:19:41', '2026-08-08 08:19:41'),
(674, 31, 31.5221529, 74.3582911, 15.00, 346.87, 18.00, '2026-08-08 08:19:45', '2026-08-08 08:19:45', '2026-08-08 08:19:45'),
(675, 31, 31.5221869, 74.3589169, 15.00, 6.92, 18.00, '2026-08-08 08:19:49', '2026-08-08 08:19:49', '2026-08-08 08:19:49'),
(676, 31, 31.5220042, 74.3595165, 15.00, 26.98, 18.00, '2026-08-08 08:19:54', '2026-08-08 08:19:54', '2026-08-08 08:19:54'),
(677, 31, 31.5216269, 74.3600171, 15.00, 47.03, 18.00, '2026-08-08 08:19:57', '2026-08-08 08:19:57', '2026-08-08 08:19:57'),
(678, 31, 31.5211009, 74.3603579, 15.00, 67.08, 18.00, '2026-08-08 08:20:01', '2026-08-08 08:20:01', '2026-08-08 08:20:01'),
(679, 31, 31.5204899, 74.3604978, 15.00, 87.14, 18.00, '2026-08-08 08:20:05', '2026-08-08 08:20:05', '2026-08-08 08:20:05'),
(680, 31, 31.5198680, 74.3604196, 15.00, 107.19, 18.00, '2026-08-08 08:20:09', '2026-08-08 08:20:09', '2026-08-08 08:20:09'),
(681, 31, 31.5193106, 74.3601329, 15.00, 127.24, 18.00, '2026-08-08 08:20:13', '2026-08-08 08:20:13', '2026-08-08 08:20:13'),
(682, 31, 31.5188853, 74.3596725, 15.00, 147.30, 18.00, '2026-08-08 08:20:17', '2026-08-08 08:20:17', '2026-08-08 08:20:17'),
(683, 31, 31.5186437, 74.3590942, 15.00, 167.35, 18.00, '2026-08-08 08:20:21', '2026-08-08 08:20:21', '2026-08-08 08:20:21'),
(684, 31, 31.5186150, 74.3584681, 15.00, 187.40, 18.00, '2026-08-08 08:20:25', '2026-08-08 08:20:25', '2026-08-08 08:20:25'),
(685, 31, 31.5188028, 74.3578700, 15.00, 207.46, 18.00, '2026-08-08 08:20:29', '2026-08-08 08:20:29', '2026-08-08 08:20:29'),
(686, 31, 31.5191842, 74.3573727, 15.00, 227.51, 18.00, '2026-08-08 08:20:33', '2026-08-08 08:20:33', '2026-08-08 08:20:33'),
(687, 31, 31.5197130, 74.3570362, 15.00, 247.56, 18.00, '2026-08-08 08:20:37', '2026-08-08 08:20:37', '2026-08-08 08:20:37'),
(688, 31, 31.5203252, 74.3569016, 15.00, 267.62, 18.00, '2026-08-08 08:20:41', '2026-08-08 08:20:41', '2026-08-08 08:20:41'),
(689, 31, 31.5209464, 74.3569849, 15.00, 287.67, 18.00, '2026-08-08 08:20:44', '2026-08-08 08:20:44', '2026-08-08 08:20:44'),
(690, 31, 31.5215014, 74.3572763, 15.00, 307.72, 18.00, '2026-08-08 08:20:49', '2026-08-08 08:20:49', '2026-08-08 08:20:49'),
(691, 31, 31.5219228, 74.3577402, 15.00, 327.78, 18.00, '2026-08-08 08:20:53', '2026-08-08 08:20:53', '2026-08-08 08:20:53'),
(692, 31, 31.5221596, 74.3583206, 15.00, 347.83, 18.00, '2026-08-08 08:20:57', '2026-08-08 08:20:57', '2026-08-08 08:20:57'),
(693, 31, 31.5221830, 74.3589469, 15.00, 7.89, 18.00, '2026-08-08 08:21:01', '2026-08-08 08:21:01', '2026-08-08 08:21:01'),
(694, 31, 31.5219902, 74.3595434, 15.00, 27.94, 18.00, '2026-08-08 08:21:05', '2026-08-08 08:21:05', '2026-08-08 08:21:05'),
(695, 31, 31.5216046, 74.3600375, 15.00, 47.99, 18.00, '2026-08-08 08:21:09', '2026-08-08 08:21:09', '2026-08-08 08:21:09'),
(696, 31, 31.5210730, 74.3603695, 15.00, 68.05, 18.00, '2026-08-08 08:21:13', '2026-08-08 08:21:13', '2026-08-08 08:21:13'),
(697, 31, 31.5204597, 74.3604990, 15.00, 88.10, 18.00, '2026-08-08 08:21:17', '2026-08-08 08:21:17', '2026-08-08 08:21:17'),
(698, 31, 31.5198392, 74.3604104, 15.00, 108.15, 18.00, '2026-08-08 08:21:21', '2026-08-08 08:21:21', '2026-08-08 08:21:21'),
(699, 31, 31.5192867, 74.3601144, 15.00, 128.21, 18.00, '2026-08-08 08:21:25', '2026-08-08 08:21:25', '2026-08-08 08:21:25'),
(700, 31, 31.5188692, 74.3596469, 15.00, 148.26, 18.00, '2026-08-08 08:21:29', '2026-08-08 08:21:29', '2026-08-08 08:21:29'),
(701, 31, 31.5186373, 74.3590646, 15.00, 168.31, 18.00, '2026-08-08 08:21:33', '2026-08-08 08:21:33', '2026-08-08 08:21:33'),
(702, 31, 31.5186192, 74.3584381, 15.00, 188.37, 18.00, '2026-08-08 08:21:37', '2026-08-08 08:21:37', '2026-08-08 08:21:37'),
(703, 31, 31.5188169, 74.3578433, 15.00, 208.42, 18.00, '2026-08-08 08:21:41', '2026-08-08 08:21:41', '2026-08-08 08:21:41'),
(704, 31, 31.5192067, 74.3573524, 15.00, 228.47, 18.00, '2026-08-08 08:21:45', '2026-08-08 08:21:45', '2026-08-08 08:21:45'),
(705, 31, 31.5197411, 74.3570249, 15.00, 248.53, 18.00, '2026-08-08 08:21:49', '2026-08-08 08:21:49', '2026-08-08 08:21:49'),
(706, 31, 31.5203554, 74.3569006, 15.00, 268.58, 18.00, '2026-08-08 08:21:53', '2026-08-08 08:21:53', '2026-08-08 08:21:53'),
(707, 31, 31.5209752, 74.3569944, 15.00, 288.63, 18.00, '2026-08-08 08:21:57', '2026-08-08 08:21:57', '2026-08-08 08:21:57'),
(708, 31, 31.5215251, 74.3572950, 15.00, 308.69, 18.00, '2026-08-08 08:22:01', '2026-08-08 08:22:01', '2026-08-08 08:22:01'),
(709, 31, 31.5219387, 74.3577660, 15.00, 328.74, 18.00, '2026-08-08 08:22:05', '2026-08-08 08:22:05', '2026-08-08 08:22:05'),
(710, 31, 31.5221657, 74.3583502, 15.00, 348.80, 18.00, '2026-08-08 08:22:09', '2026-08-08 08:22:09', '2026-08-08 08:22:09'),
(711, 31, 31.5221786, 74.3589769, 15.00, 8.85, 18.00, '2026-08-08 08:22:13', '2026-08-08 08:22:13', '2026-08-08 08:22:13'),
(712, 31, 31.5219758, 74.3595700, 15.00, 28.90, 18.00, '2026-08-08 08:22:17', '2026-08-08 08:22:17', '2026-08-08 08:22:17'),
(713, 31, 31.5215820, 74.3600576, 15.00, 48.96, 18.00, '2026-08-08 08:22:21', '2026-08-08 08:22:21', '2026-08-08 08:22:21'),
(714, 31, 31.5210448, 74.3603806, 15.00, 69.01, 18.00, '2026-08-08 08:22:25', '2026-08-08 08:22:25', '2026-08-08 08:22:25'),
(715, 31, 31.5204294, 74.3604998, 15.00, 89.06, 18.00, '2026-08-08 08:22:29', '2026-08-08 08:22:29', '2026-08-08 08:22:29'),
(716, 31, 31.5198105, 74.3604007, 15.00, 109.12, 18.00, '2026-08-08 08:22:33', '2026-08-08 08:22:33', '2026-08-08 08:22:33'),
(717, 31, 31.5192631, 74.3600955, 15.00, 129.17, 18.00, '2026-08-08 08:22:37', '2026-08-08 08:22:37', '2026-08-08 08:22:37'),
(718, 31, 31.5188535, 74.3596210, 15.00, 149.22, 18.00, '2026-08-08 08:22:41', '2026-08-08 08:22:41', '2026-08-08 08:22:41'),
(719, 31, 31.5186314, 74.3590349, 15.00, 169.28, 18.00, '2026-08-08 08:22:45', '2026-08-08 08:22:45', '2026-08-08 08:22:45'),
(720, 31, 31.5186238, 74.3584082, 15.00, 189.33, 18.00, '2026-08-08 08:22:49', '2026-08-08 08:22:49', '2026-08-08 08:22:49'),
(721, 31, 31.5188316, 74.3578168, 15.00, 209.38, 18.00, '2026-08-08 08:22:53', '2026-08-08 08:22:53', '2026-08-08 08:22:53'),
(722, 31, 31.5192295, 74.3573325, 15.00, 229.44, 18.00, '2026-08-08 08:22:57', '2026-08-08 08:22:57', '2026-08-08 08:22:57'),
(723, 31, 31.5197694, 74.3570141, 15.00, 249.49, 18.00, '2026-08-08 08:23:01', '2026-08-08 08:23:01', '2026-08-08 08:23:01'),
(724, 31, 31.5203857, 74.3569001, 15.00, 269.54, 18.00, '2026-08-08 08:23:05', '2026-08-08 08:23:05', '2026-08-08 08:23:05'),
(725, 31, 31.5210038, 74.3570043, 15.00, 289.60, 18.00, '2026-08-08 08:23:09', '2026-08-08 08:23:09', '2026-08-08 08:23:09'),
(726, 31, 31.5215486, 74.3573141, 15.00, 309.65, 18.00, '2026-08-08 08:23:13', '2026-08-08 08:23:13', '2026-08-08 08:23:13'),
(727, 31, 31.5219542, 74.3577920, 15.00, 329.71, 18.00, '2026-08-08 08:23:17', '2026-08-08 08:23:17', '2026-08-08 08:23:17'),
(728, 31, 31.5221713, 74.3583800, 15.00, 349.76, 18.00, '2026-08-08 08:23:21', '2026-08-08 08:23:21', '2026-08-08 08:23:21'),
(729, 31, 31.5221737, 74.3590068, 15.00, 9.81, 18.00, '2026-08-08 08:23:25', '2026-08-08 08:23:25', '2026-08-08 08:23:25'),
(730, 31, 31.5219610, 74.3595963, 15.00, 29.87, 18.00, '2026-08-08 08:23:29', '2026-08-08 08:23:29', '2026-08-08 08:23:29'),
(731, 31, 31.5215590, 74.3600772, 15.00, 49.92, 18.00, '2026-08-08 08:23:33', '2026-08-08 08:23:33', '2026-08-08 08:23:33'),
(732, 31, 31.5210164, 74.3603912, 15.00, 69.97, 18.00, '2026-08-08 08:23:37', '2026-08-08 08:23:37', '2026-08-08 08:23:37'),
(733, 31, 31.5203992, 74.3605000, 15.00, 90.03, 18.00, '2026-08-08 08:23:41', '2026-08-08 08:23:41', '2026-08-08 08:23:41'),
(734, 31, 31.5197820, 74.3603906, 15.00, 110.08, 18.00, '2026-08-08 08:23:45', '2026-08-08 08:23:45', '2026-08-08 08:23:45'),
(735, 31, 31.5192398, 74.3600762, 15.00, 130.13, 18.00, '2026-08-08 08:23:49', '2026-08-08 08:23:49', '2026-08-08 08:23:49'),
(736, 31, 31.5188382, 74.3595949, 15.00, 150.19, 18.00, '2026-08-08 08:23:53', '2026-08-08 08:23:53', '2026-08-08 08:23:53'),
(737, 31, 31.5186261, 74.3590051, 15.00, 170.24, 18.00, '2026-08-08 08:23:57', '2026-08-08 08:23:57', '2026-08-08 08:23:57'),
(738, 31, 31.5186290, 74.3583783, 15.00, 190.29, 18.00, '2026-08-08 08:24:01', '2026-08-08 08:24:01', '2026-08-08 08:24:01'),
(739, 31, 31.5188466, 74.3577906, 15.00, 210.35, 18.00, '2026-08-08 08:24:05', '2026-08-08 08:24:05', '2026-08-08 08:24:05'),
(740, 31, 31.5192527, 74.3573131, 15.00, 230.40, 18.00, '2026-08-08 08:24:09', '2026-08-08 08:24:09', '2026-08-08 08:24:09'),
(741, 31, 31.5197978, 74.3570037, 15.00, 250.45, 18.00, '2026-08-08 08:24:13', '2026-08-08 08:24:13', '2026-08-08 08:24:13'),
(742, 31, 31.5204160, 74.3569001, 15.00, 270.51, 18.00, '2026-08-08 08:24:17', '2026-08-08 08:24:17', '2026-08-08 08:24:17'),
(743, 31, 31.5210322, 74.3570147, 15.00, 290.56, 18.00, '2026-08-08 08:24:21', '2026-08-08 08:24:21', '2026-08-08 08:24:21'),
(744, 31, 31.5215718, 74.3573336, 15.00, 310.62, 18.00, '2026-08-08 08:24:25', '2026-08-08 08:24:25', '2026-08-08 08:24:25'),
(745, 31, 31.5219692, 74.3578183, 15.00, 330.67, 18.00, '2026-08-08 08:24:28', '2026-08-08 08:24:28', '2026-08-08 08:24:28'),
(746, 31, 31.5221765, 74.3584098, 15.00, 350.72, 18.00, '2026-08-08 08:24:32', '2026-08-08 08:24:32', '2026-08-08 08:24:32'),
(747, 31, 31.5221683, 74.3590365, 15.00, 10.78, 18.00, '2026-08-08 08:24:37', '2026-08-08 08:24:37', '2026-08-08 08:24:37'),
(748, 31, 31.5219457, 74.3596225, 15.00, 30.83, 18.00, '2026-08-08 08:24:40', '2026-08-08 08:24:40', '2026-08-08 08:24:40'),
(749, 31, 31.5215356, 74.3600965, 15.00, 50.88, 18.00, '2026-08-08 08:24:45', '2026-08-08 08:24:45', '2026-08-08 08:24:45'),
(750, 31, 31.5209879, 74.3604013, 15.00, 70.94, 18.00, '2026-08-08 08:24:49', '2026-08-08 08:24:49', '2026-08-08 08:24:49'),
(751, 31, 31.5203689, 74.3604997, 15.00, 90.99, 18.00, '2026-08-08 08:24:53', '2026-08-08 08:24:53', '2026-08-08 08:24:53'),
(752, 31, 31.5197537, 74.3603800, 15.00, 111.04, 18.00, '2026-08-08 08:24:57', '2026-08-08 08:24:57', '2026-08-08 08:24:57'),
(753, 31, 31.5192168, 74.3600565, 15.00, 131.10, 18.00, '2026-08-08 08:25:01', '2026-08-08 08:25:01', '2026-08-08 08:25:01'),
(754, 31, 31.5188234, 74.3595685, 15.00, 151.15, 18.00, '2026-08-08 08:25:05', '2026-08-08 08:25:05', '2026-08-08 08:25:05'),
(755, 31, 31.5186212, 74.3589753, 15.00, 171.20, 18.00, '2026-08-08 08:25:09', '2026-08-08 08:25:09', '2026-08-08 08:25:09'),
(756, 31, 31.5186346, 74.3583486, 15.00, 191.26, 18.00, '2026-08-08 08:25:13', '2026-08-08 08:25:13', '2026-08-08 08:25:13'),
(757, 31, 31.5188622, 74.3577646, 15.00, 211.31, 18.00, '2026-08-08 08:25:17', '2026-08-08 08:25:17', '2026-08-08 08:25:17'),
(758, 31, 31.5192761, 74.3572940, 15.00, 231.36, 18.00, '2026-08-08 08:25:21', '2026-08-08 08:25:21', '2026-08-08 08:25:21'),
(759, 31, 31.5198264, 74.3569938, 15.00, 251.42, 18.00, '2026-08-08 08:25:25', '2026-08-08 08:25:25', '2026-08-08 08:25:25'),
(760, 31, 31.5204462, 74.3569006, 15.00, 271.47, 18.00, '2026-08-08 08:25:29', '2026-08-08 08:25:29', '2026-08-08 08:25:29'),
(761, 31, 31.5210604, 74.3570255, 15.00, 291.52, 18.00, '2026-08-08 08:25:33', '2026-08-08 08:25:33', '2026-08-08 08:25:33'),
(762, 31, 31.5215946, 74.3573535, 15.00, 311.58, 18.00, '2026-08-08 08:25:37', '2026-08-08 08:25:37', '2026-08-08 08:25:37'),
(763, 31, 31.5219838, 74.3578448, 15.00, 331.63, 18.00, '2026-08-08 08:25:41', '2026-08-08 08:25:41', '2026-08-08 08:25:41'),
(764, 31, 31.5221811, 74.3584397, 15.00, 351.69, 18.00, '2026-08-08 08:25:45', '2026-08-08 08:25:45', '2026-08-08 08:25:45'),
(765, 31, 31.5221624, 74.3590662, 15.00, 11.74, 18.00, '2026-08-08 08:25:49', '2026-08-08 08:25:49', '2026-08-08 08:25:49'),
(766, 31, 31.5219299, 74.3596483, 15.00, 31.79, 18.00, '2026-08-08 08:25:53', '2026-08-08 08:25:53', '2026-08-08 08:25:53'),
(767, 31, 31.5215120, 74.3601154, 15.00, 51.85, 18.00, '2026-08-08 08:25:57', '2026-08-08 08:25:57', '2026-08-08 08:25:57'),
(768, 31, 31.5209592, 74.3604109, 15.00, 71.90, 18.00, '2026-08-08 08:26:01', '2026-08-08 08:26:01', '2026-08-08 08:26:01'),
(769, 31, 31.5203387, 74.3604990, 15.00, 91.95, 18.00, '2026-08-08 08:26:05', '2026-08-08 08:26:05', '2026-08-08 08:26:05'),
(770, 31, 31.5197255, 74.3603689, 15.00, 112.01, 18.00, '2026-08-08 08:26:09', '2026-08-08 08:26:09', '2026-08-08 08:26:09'),
(771, 31, 31.5191942, 74.3600364, 15.00, 132.06, 18.00, '2026-08-08 08:26:14', '2026-08-08 08:26:14', '2026-08-08 08:26:14'),
(772, 31, 31.5188090, 74.3595419, 15.00, 152.11, 18.00, '2026-08-08 08:26:17', '2026-08-08 08:26:17', '2026-08-08 08:26:17'),
(773, 31, 31.5186168, 74.3589453, 15.00, 172.17, 18.00, '2026-08-08 08:26:21', '2026-08-08 08:26:21', '2026-08-08 08:26:21'),
(774, 31, 31.5186408, 74.3583190, 15.00, 192.22, 18.00, '2026-08-08 08:26:25', '2026-08-08 08:26:25', '2026-08-08 08:26:25'),
(775, 31, 31.5188781, 74.3577388, 15.00, 212.27, 18.00, '2026-08-08 08:26:29', '2026-08-08 08:26:29', '2026-08-08 08:26:29'),
(776, 31, 31.5192999, 74.3572753, 15.00, 232.33, 18.00, '2026-08-08 08:26:33', '2026-08-08 08:26:33', '2026-08-08 08:26:33'),
(777, 31, 31.5198552, 74.3569844, 15.00, 252.38, 18.00, '2026-08-08 08:26:37', '2026-08-08 08:26:37', '2026-08-08 08:26:37'),
(778, 31, 31.5204765, 74.3569016, 15.00, 272.43, 18.00, '2026-08-08 08:26:41', '2026-08-08 08:26:41', '2026-08-08 08:26:41'),
(779, 31, 31.5210885, 74.3570369, 15.00, 292.49, 18.00, '2026-08-08 08:26:45', '2026-08-08 08:26:45', '2026-08-08 08:26:45'),
(780, 31, 31.5216170, 74.3573738, 15.00, 312.54, 18.00, '2026-08-08 08:26:49', '2026-08-08 08:26:49', '2026-08-08 08:26:49'),
(781, 31, 31.5219980, 74.3578715, 15.00, 332.60, 18.00, '2026-08-08 08:26:53', '2026-08-08 08:26:53', '2026-08-08 08:26:53'),
(782, 31, 31.5221852, 74.3584697, 15.00, 352.65, 18.00, '2026-08-08 08:26:57', '2026-08-08 08:26:57', '2026-08-08 08:26:57'),
(783, 31, 31.5221559, 74.3590958, 15.00, 12.70, 18.00, '2026-08-08 08:27:01', '2026-08-08 08:27:01', '2026-08-08 08:27:01'),
(784, 31, 31.5219138, 74.3596739, 15.00, 32.76, 18.00, '2026-08-08 08:27:05', '2026-08-08 08:27:05', '2026-08-08 08:27:05'),
(785, 31, 31.5214880, 74.3601339, 15.00, 52.81, 18.00, '2026-08-08 08:27:09', '2026-08-08 08:27:09', '2026-08-08 08:27:09'),
(786, 31, 31.5209304, 74.3604201, 15.00, 72.86, 18.00, '2026-08-08 08:27:13', '2026-08-08 08:27:13', '2026-08-08 08:27:13'),
(787, 31, 31.5203084, 74.3604977, 15.00, 92.92, 18.00, '2026-08-08 08:27:17', '2026-08-08 08:27:17', '2026-08-08 08:27:17'),
(788, 31, 31.5196975, 74.3603573, 15.00, 112.97, 18.00, '2026-08-08 08:27:21', '2026-08-08 08:27:21', '2026-08-08 08:27:21'),
(789, 31, 31.5191719, 74.3600159, 15.00, 133.02, 18.00, '2026-08-08 08:27:25', '2026-08-08 08:27:25', '2026-08-08 08:27:25'),
(790, 31, 31.5187951, 74.3595150, 15.00, 153.08, 18.00, '2026-08-08 08:27:29', '2026-08-08 08:27:29', '2026-08-08 08:27:29'),
(791, 31, 31.5186129, 74.3589153, 15.00, 173.13, 18.00, '2026-08-08 08:27:35', '2026-08-08 08:27:35', '2026-08-08 08:27:35'),
(792, 31, 31.5186474, 74.3582895, 15.00, 193.18, 18.00, '2026-08-08 08:27:37', '2026-08-08 08:27:37', '2026-08-08 08:27:37'),
(793, 31, 31.5188945, 74.3577134, 15.00, 213.24, 18.00, '2026-08-08 08:27:41', '2026-08-08 08:27:41', '2026-08-08 08:27:41'),
(794, 31, 31.5193241, 74.3572570, 15.00, 233.29, 18.00, '2026-08-08 08:27:45', '2026-08-08 08:27:45', '2026-08-08 08:27:45'),
(795, 31, 31.5198841, 74.3569755, 15.00, 253.34, 18.00, '2026-08-08 08:27:49', '2026-08-08 08:27:49', '2026-08-08 08:27:49'),
(796, 31, 31.5205067, 74.3569032, 15.00, 273.40, 18.00, '2026-08-08 08:27:53', '2026-08-08 08:27:53', '2026-08-08 08:27:53'),
(797, 31, 31.5211164, 74.3570487, 15.00, 293.45, 18.00, '2026-08-08 08:27:57', '2026-08-08 08:27:57', '2026-08-08 08:27:57'),
(798, 31, 31.5216392, 74.3573944, 15.00, 313.51, 18.00, '2026-08-08 08:28:01', '2026-08-08 08:28:01', '2026-08-08 08:28:01'),
(799, 31, 31.5220117, 74.3578985, 15.00, 333.56, 18.00, '2026-08-08 08:28:05', '2026-08-08 08:28:05', '2026-08-08 08:28:05'),
(800, 31, 31.5221888, 74.3584997, 15.00, 353.61, 18.00, '2026-08-08 08:28:09', '2026-08-08 08:28:09', '2026-08-08 08:28:09'),
(801, 31, 31.5221490, 74.3591253, 15.00, 13.67, 18.00, '2026-08-08 08:28:13', '2026-08-08 08:28:13', '2026-08-08 08:28:13'),
(802, 31, 31.5218972, 74.3596992, 15.00, 33.72, 18.00, '2026-08-08 08:28:17', '2026-08-08 08:28:17', '2026-08-08 08:28:17'),
(803, 31, 31.5214638, 74.3601520, 15.00, 53.77, 18.00, '2026-08-08 08:28:21', '2026-08-08 08:28:21', '2026-08-08 08:28:21'),
(804, 31, 31.5209014, 74.3604288, 15.00, 73.83, 18.00, '2026-08-08 08:28:25', '2026-08-08 08:28:25', '2026-08-08 08:28:25'),
(805, 31, 31.5202782, 74.3604959, 15.00, 93.88, 18.00, '2026-08-08 08:28:29', '2026-08-08 08:28:29', '2026-08-08 08:28:29'),
(806, 31, 31.5196698, 74.3603452, 15.00, 113.93, 18.00, '2026-08-08 08:28:33', '2026-08-08 08:28:33', '2026-08-08 08:28:33'),
(807, 31, 31.5191499, 74.3599951, 15.00, 133.99, 18.00, '2026-08-08 08:28:37', '2026-08-08 08:28:37', '2026-08-08 08:28:37'),
(808, 31, 31.5187816, 74.3594879, 15.00, 154.04, 18.00, '2026-08-08 08:28:41', '2026-08-08 08:28:41', '2026-08-08 08:28:41'),
(809, 31, 31.5186096, 74.3588852, 15.00, 174.09, 18.00, '2026-08-08 08:28:45', '2026-08-08 08:28:45', '2026-08-08 08:28:45'),
(810, 31, 31.5186546, 74.3582600, 15.00, 194.15, 18.00, '2026-08-08 08:28:49', '2026-08-08 08:28:49', '2026-08-08 08:28:49'),
(811, 31, 31.5189113, 74.3576882, 15.00, 214.20, 18.00, '2026-08-08 08:28:53', '2026-08-08 08:28:53', '2026-08-08 08:28:53');
INSERT INTO `trip_locations` (`id`, `trip_id`, `latitude`, `longitude`, `accuracy`, `heading`, `speed`, `recorded_at`, `created_at`, `updated_at`) VALUES
(812, 31, 31.5193485, 74.3572391, 15.00, 234.25, 18.00, '2026-08-08 08:28:57', '2026-08-08 08:28:57', '2026-08-08 08:28:57'),
(813, 31, 31.5199132, 74.3569671, 15.00, 254.31, 18.00, '2026-08-08 08:29:01', '2026-08-08 08:29:01', '2026-08-08 08:29:01'),
(814, 31, 31.5205369, 74.3569052, 15.00, 274.36, 18.00, '2026-08-08 08:29:05', '2026-08-08 08:29:05', '2026-08-08 08:29:05'),
(815, 31, 31.5211440, 74.3570610, 15.00, 294.42, 18.00, '2026-08-08 08:29:09', '2026-08-08 08:29:09', '2026-08-08 08:29:09'),
(816, 31, 31.5216609, 74.3574155, 15.00, 314.47, 18.00, '2026-08-08 08:29:13', '2026-08-08 08:29:13', '2026-08-08 08:29:13'),
(817, 31, 31.5220250, 74.3579257, 15.00, 334.52, 18.00, '2026-08-08 08:29:17', '2026-08-08 08:29:17', '2026-08-08 08:29:17'),
(818, 31, 31.5221919, 74.3585298, 15.00, 354.58, 18.00, '2026-08-08 08:29:21', '2026-08-08 08:29:21', '2026-08-08 08:29:21'),
(819, 31, 31.5221416, 74.3591546, 15.00, 14.63, 18.00, '2026-08-08 08:29:25', '2026-08-08 08:29:25', '2026-08-08 08:29:25'),
(820, 31, 31.5218802, 74.3597243, 15.00, 34.68, 18.00, '2026-08-08 08:29:29', '2026-08-08 08:29:29', '2026-08-08 08:29:29'),
(821, 31, 31.5214392, 74.3601697, 15.00, 54.74, 18.00, '2026-08-08 08:29:33', '2026-08-08 08:29:33', '2026-08-08 08:29:33'),
(822, 31, 31.5208722, 74.3604369, 15.00, 74.79, 18.00, '2026-08-08 08:29:37', '2026-08-08 08:29:37', '2026-08-08 08:29:37'),
(823, 31, 31.5202480, 74.3604936, 15.00, 94.84, 18.00, '2026-08-08 08:29:41', '2026-08-08 08:29:41', '2026-08-08 08:29:41'),
(824, 31, 31.5196422, 74.3603327, 15.00, 114.90, 18.00, '2026-08-08 08:29:45', '2026-08-08 08:29:45', '2026-08-08 08:29:45'),
(825, 31, 31.5191283, 74.3599739, 15.00, 134.95, 18.00, '2026-08-08 08:29:49', '2026-08-08 08:29:49', '2026-08-08 08:29:49'),
(826, 31, 31.5187686, 74.3594606, 15.00, 155.00, 18.00, '2026-08-08 08:29:53', '2026-08-08 08:29:53', '2026-08-08 08:29:53'),
(827, 31, 31.5186067, 74.3588551, 15.00, 175.06, 18.00, '2026-08-08 08:29:57', '2026-08-08 08:29:57', '2026-08-08 08:29:57'),
(828, 31, 31.5186622, 74.3582308, 15.00, 195.11, 18.00, '2026-08-08 08:30:01', '2026-08-08 08:30:01', '2026-08-08 08:30:01'),
(829, 31, 31.5189285, 74.3576633, 15.00, 215.16, 18.00, '2026-08-08 08:30:05', '2026-08-08 08:30:05', '2026-08-08 08:30:05'),
(830, 31, 31.5193732, 74.3572216, 15.00, 235.22, 18.00, '2026-08-08 08:30:09', '2026-08-08 08:30:09', '2026-08-08 08:30:09'),
(831, 31, 31.5199424, 74.3569591, 15.00, 255.27, 18.00, '2026-08-08 08:30:13', '2026-08-08 08:30:13', '2026-08-08 08:30:13'),
(832, 31, 31.5205671, 74.3569078, 15.00, 275.33, 18.00, '2026-08-08 08:30:17', '2026-08-08 08:30:17', '2026-08-08 08:30:17'),
(833, 31, 31.5211715, 74.3570737, 15.00, 295.38, 18.00, '2026-08-08 08:30:21', '2026-08-08 08:30:21', '2026-08-08 08:30:21'),
(834, 31, 31.5216824, 74.3574368, 15.00, 315.43, 18.00, '2026-08-08 08:30:25', '2026-08-08 08:30:25', '2026-08-08 08:30:25'),
(835, 31, 31.5220377, 74.3579531, 15.00, 335.49, 18.00, '2026-08-08 08:30:29', '2026-08-08 08:30:29', '2026-08-08 08:30:29'),
(836, 31, 31.5221945, 74.3585600, 15.00, 355.54, 18.00, '2026-08-08 08:30:33', '2026-08-08 08:30:33', '2026-08-08 08:30:33'),
(837, 31, 31.5221338, 74.3591838, 15.00, 15.59, 18.00, '2026-08-08 08:30:37', '2026-08-08 08:30:37', '2026-08-08 08:30:37'),
(838, 31, 31.5218627, 74.3597490, 15.00, 35.65, 18.00, '2026-08-08 08:30:41', '2026-08-08 08:30:41', '2026-08-08 08:30:41'),
(839, 31, 31.5214144, 74.3601870, 15.00, 55.70, 18.00, '2026-08-08 08:30:45', '2026-08-08 08:30:45', '2026-08-08 08:30:45'),
(840, 31, 31.5208430, 74.3604446, 15.00, 75.75, 18.00, '2026-08-08 08:30:49', '2026-08-08 08:30:49', '2026-08-08 08:30:49'),
(841, 31, 31.5202179, 74.3604908, 15.00, 95.81, 18.00, '2026-08-08 08:30:53', '2026-08-08 08:30:53', '2026-08-08 08:30:53'),
(842, 31, 31.5196149, 74.3603197, 15.00, 115.86, 18.00, '2026-08-08 08:30:57', '2026-08-08 08:30:57', '2026-08-08 08:30:57'),
(843, 31, 31.5191071, 74.3599523, 15.00, 135.91, 18.00, '2026-08-08 08:31:01', '2026-08-08 08:31:01', '2026-08-08 08:31:01'),
(844, 31, 31.5187560, 74.3594331, 15.00, 155.97, 18.00, '2026-08-08 08:31:05', '2026-08-08 08:31:05', '2026-08-08 08:31:05'),
(845, 31, 31.5186043, 74.3588249, 15.00, 176.02, 18.00, '2026-08-08 08:31:09', '2026-08-08 08:31:09', '2026-08-08 08:31:09'),
(846, 31, 31.5186704, 74.3582016, 15.00, 196.07, 18.00, '2026-08-08 08:31:13', '2026-08-08 08:31:13', '2026-08-08 08:31:13'),
(847, 31, 31.5189461, 74.3576387, 15.00, 216.13, 18.00, '2026-08-08 08:31:17', '2026-08-08 08:31:17', '2026-08-08 08:31:17'),
(848, 31, 31.5193982, 74.3572046, 15.00, 236.18, 18.00, '2026-08-08 08:31:21', '2026-08-08 08:31:21', '2026-08-08 08:31:21'),
(849, 31, 31.5199717, 74.3569517, 15.00, 256.23, 18.00, '2026-08-08 08:31:25', '2026-08-08 08:31:25', '2026-08-08 08:31:25'),
(850, 31, 31.5205972, 74.3569108, 15.00, 276.29, 18.00, '2026-08-08 08:31:29', '2026-08-08 08:31:29', '2026-08-08 08:31:29'),
(851, 31, 31.5211987, 74.3570869, 15.00, 296.34, 18.00, '2026-08-08 08:31:33', '2026-08-08 08:31:33', '2026-08-08 08:31:33'),
(852, 31, 31.5217034, 74.3574586, 15.00, 316.40, 18.00, '2026-08-08 08:31:37', '2026-08-08 08:31:37', '2026-08-08 08:31:37'),
(853, 31, 31.5220501, 74.3579808, 15.00, 336.45, 18.00, '2026-08-08 08:31:41', '2026-08-08 08:31:41', '2026-08-08 08:31:41'),
(854, 31, 31.5221966, 74.3585902, 15.00, 356.50, 18.00, '2026-08-08 08:31:45', '2026-08-08 08:31:45', '2026-08-08 08:31:45'),
(855, 31, 31.5221254, 74.3592129, 15.00, 16.56, 18.00, '2026-08-08 08:31:49', '2026-08-08 08:31:49', '2026-08-08 08:31:49'),
(856, 31, 31.5218449, 74.3597734, 15.00, 36.61, 18.00, '2026-08-08 08:31:53', '2026-08-08 08:31:53', '2026-08-08 08:31:53'),
(857, 31, 31.5213892, 74.3602038, 15.00, 56.66, 18.00, '2026-08-08 08:31:57', '2026-08-08 08:31:57', '2026-08-08 08:31:57'),
(858, 31, 31.5208136, 74.3604518, 15.00, 76.72, 18.00, '2026-08-08 08:32:01', '2026-08-08 08:32:01', '2026-08-08 08:32:01'),
(859, 31, 31.5201878, 74.3604874, 15.00, 96.77, 18.00, '2026-08-08 08:32:05', '2026-08-08 08:32:05', '2026-08-08 08:32:05'),
(860, 31, 31.5195878, 74.3603063, 15.00, 116.82, 18.00, '2026-08-08 08:32:09', '2026-08-08 08:32:09', '2026-08-08 08:32:09'),
(861, 31, 31.5190862, 74.3599304, 15.00, 136.88, 18.00, '2026-08-08 08:32:13', '2026-08-08 08:32:13', '2026-08-08 08:32:13'),
(862, 31, 31.5187439, 74.3594053, 15.00, 156.93, 18.00, '2026-08-08 08:32:17', '2026-08-08 08:32:17', '2026-08-08 08:32:17'),
(863, 31, 31.5186025, 74.3587947, 15.00, 176.98, 18.00, '2026-08-08 08:32:21', '2026-08-08 08:32:21', '2026-08-08 08:32:21'),
(864, 31, 31.5186790, 74.3581726, 15.00, 197.04, 18.00, '2026-08-08 08:32:25', '2026-08-08 08:32:25', '2026-08-08 08:32:25'),
(865, 31, 31.5189642, 74.3576144, 15.00, 217.09, 18.00, '2026-08-08 08:32:29', '2026-08-08 08:32:29', '2026-08-08 08:32:29'),
(866, 31, 31.5194235, 74.3571879, 15.00, 237.14, 18.00, '2026-08-08 08:32:33', '2026-08-08 08:32:33', '2026-08-08 08:32:33'),
(867, 31, 31.5200012, 74.3569447, 15.00, 257.20, 18.00, '2026-08-08 08:32:37', '2026-08-08 08:32:37', '2026-08-08 08:32:37'),
(868, 31, 31.5206272, 74.3569144, 15.00, 277.25, 18.00, '2026-08-08 08:32:41', '2026-08-08 08:32:41', '2026-08-08 08:32:41'),
(869, 31, 31.5212257, 74.3571006, 15.00, 297.31, 18.00, '2026-08-08 08:32:45', '2026-08-08 08:32:45', '2026-08-08 08:32:45'),
(870, 31, 31.5217241, 74.3574807, 15.00, 317.36, 18.00, '2026-08-08 08:32:49', '2026-08-08 08:32:49', '2026-08-08 08:32:49'),
(871, 31, 31.5220619, 74.3580086, 15.00, 337.41, 18.00, '2026-08-08 08:32:53', '2026-08-08 08:32:53', '2026-08-08 08:32:53'),
(872, 31, 31.5221982, 74.3586204, 15.00, 357.47, 18.00, '2026-08-08 08:32:57', '2026-08-08 08:32:57', '2026-08-08 08:32:57'),
(873, 31, 31.5221165, 74.3592419, 15.00, 17.52, 18.00, '2026-08-08 08:33:01', '2026-08-08 08:33:01', '2026-08-08 08:33:01'),
(874, 31, 31.5218266, 74.3597976, 15.00, 37.57, 18.00, '2026-08-08 08:33:05', '2026-08-08 08:33:05', '2026-08-08 08:33:05'),
(875, 31, 31.5213638, 74.3602202, 15.00, 57.63, 18.00, '2026-08-08 08:33:09', '2026-08-08 08:33:09', '2026-08-08 08:33:09'),
(876, 31, 31.5207841, 74.3604585, 15.00, 77.68, 18.00, '2026-08-08 08:33:13', '2026-08-08 08:33:13', '2026-08-08 08:33:13'),
(877, 31, 31.5201578, 74.3604836, 15.00, 97.73, 18.00, '2026-08-08 08:33:17', '2026-08-08 08:33:17', '2026-08-08 08:33:17'),
(878, 31, 31.5195609, 74.3602924, 15.00, 117.79, 18.00, '2026-08-08 08:33:21', '2026-08-08 08:33:21', '2026-08-08 08:33:21'),
(879, 31, 31.5190657, 74.3599082, 15.00, 137.84, 18.00, '2026-08-08 08:33:25', '2026-08-08 08:33:25', '2026-08-08 08:33:25'),
(880, 31, 31.5187323, 74.3593774, 15.00, 157.89, 18.00, '2026-08-08 08:33:29', '2026-08-08 08:33:29', '2026-08-08 08:33:29'),
(881, 31, 31.5186012, 74.3587645, 15.00, 177.95, 18.00, '2026-08-08 08:33:33', '2026-08-08 08:33:33', '2026-08-08 08:33:33'),
(882, 31, 31.5186881, 74.3581437, 15.00, 198.00, 18.00, '2026-08-08 08:33:37', '2026-08-08 08:33:37', '2026-08-08 08:33:37'),
(883, 31, 31.5189826, 74.3575905, 15.00, 218.05, 18.00, '2026-08-08 08:33:41', '2026-08-08 08:33:41', '2026-08-08 08:33:41'),
(884, 31, 31.5194490, 74.3571717, 15.00, 238.11, 18.00, '2026-08-08 08:33:45', '2026-08-08 08:33:45', '2026-08-08 08:33:45'),
(885, 31, 31.5200307, 74.3569383, 15.00, 258.16, 18.00, '2026-08-08 08:33:49', '2026-08-08 08:33:49', '2026-08-08 08:33:49'),
(886, 31, 31.5206572, 74.3569185, 15.00, 278.22, 18.00, '2026-08-08 08:33:53', '2026-08-08 08:33:53', '2026-08-08 08:33:53'),
(887, 31, 31.5212525, 74.3571147, 15.00, 298.27, 18.00, '2026-08-08 08:33:57', '2026-08-08 08:33:57', '2026-08-08 08:33:57'),
(888, 31, 31.5217444, 74.3575031, 15.00, 318.32, 18.00, '2026-08-08 08:34:01', '2026-08-08 08:34:01', '2026-08-08 08:34:01'),
(889, 31, 31.5220733, 74.3580367, 15.00, 338.38, 18.00, '2026-08-08 08:34:05', '2026-08-08 08:34:05', '2026-08-08 08:34:05'),
(890, 31, 31.5221993, 74.3586507, 15.00, 358.43, 18.00, '2026-08-08 08:34:09', '2026-08-08 08:34:09', '2026-08-08 08:34:09'),
(891, 31, 31.5221072, 74.3592706, 15.00, 18.48, 18.00, '2026-08-08 08:34:13', '2026-08-08 08:34:13', '2026-08-08 08:34:13'),
(892, 31, 31.5218080, 74.3598214, 15.00, 38.54, 18.00, '2026-08-08 08:34:17', '2026-08-08 08:34:17', '2026-08-08 08:34:17'),
(893, 31, 31.5213381, 74.3602362, 15.00, 58.59, 18.00, '2026-08-08 08:34:21', '2026-08-08 08:34:21', '2026-08-08 08:34:21'),
(894, 31, 31.5207544, 74.3604648, 15.00, 78.64, 18.00, '2026-08-08 08:34:25', '2026-08-08 08:34:25', '2026-08-08 08:34:25'),
(895, 31, 31.5201278, 74.3604793, 15.00, 98.70, 18.00, '2026-08-08 08:34:29', '2026-08-08 08:34:29', '2026-08-08 08:34:29'),
(896, 31, 31.5195342, 74.3602781, 15.00, 118.75, 18.00, '2026-08-08 08:34:33', '2026-08-08 08:34:33', '2026-08-08 08:34:33'),
(897, 31, 31.5190456, 74.3598855, 15.00, 138.80, 18.00, '2026-08-08 08:34:37', '2026-08-08 08:34:37', '2026-08-08 08:34:37'),
(898, 31, 31.5187212, 74.3593492, 15.00, 158.86, 18.00, '2026-08-08 08:34:41', '2026-08-08 08:34:41', '2026-08-08 08:34:41'),
(899, 31, 31.5186003, 74.3587342, 15.00, 178.91, 18.00, '2026-08-08 08:34:45', '2026-08-08 08:34:45', '2026-08-08 08:34:45'),
(900, 31, 31.5186977, 74.3581150, 15.00, 198.96, 18.00, '2026-08-08 08:34:49', '2026-08-08 08:34:49', '2026-08-08 08:34:49'),
(901, 31, 31.5190015, 74.3575668, 15.00, 219.02, 18.00, '2026-08-08 08:34:54', '2026-08-08 08:34:54', '2026-08-08 08:34:54'),
(902, 31, 31.5194749, 74.3571559, 15.00, 239.07, 18.00, '2026-08-08 08:34:58', '2026-08-08 08:34:58', '2026-08-08 08:34:58'),
(903, 31, 31.5200604, 74.3569323, 15.00, 259.13, 18.00, '2026-08-08 08:35:01', '2026-08-08 08:35:01', '2026-08-08 08:35:01'),
(904, 31, 31.5206871, 74.3569230, 15.00, 279.18, 18.00, '2026-08-08 08:35:05', '2026-08-08 08:35:05', '2026-08-08 08:35:05'),
(905, 31, 31.5212790, 74.3571292, 15.00, 299.23, 18.00, '2026-08-08 08:35:09', '2026-08-08 08:35:09', '2026-08-08 08:35:09'),
(906, 31, 31.5217643, 74.3575259, 15.00, 319.29, 18.00, '2026-08-08 08:35:13', '2026-08-08 08:35:13', '2026-08-08 08:35:13'),
(907, 31, 31.5220842, 74.3580649, 15.00, 339.34, 18.00, '2026-08-08 08:35:17', '2026-08-08 08:35:17', '2026-08-08 08:35:17'),
(908, 31, 31.5221999, 74.3586809, 15.00, 359.39, 18.00, '2026-08-08 08:35:21', '2026-08-08 08:35:21', '2026-08-08 08:35:21'),
(909, 31, 31.5220973, 74.3592993, 15.00, 19.45, 18.00, '2026-08-08 08:35:25', '2026-08-08 08:35:25', '2026-08-08 08:35:25'),
(910, 31, 31.5217889, 74.3598449, 15.00, 39.50, 18.00, '2026-08-08 08:35:30', '2026-08-08 08:35:30', '2026-08-08 08:35:30'),
(911, 31, 31.5213121, 74.3602518, 15.00, 59.55, 18.00, '2026-08-08 08:35:33', '2026-08-08 08:35:33', '2026-08-08 08:35:33'),
(912, 31, 31.5207247, 74.3604705, 15.00, 79.61, 18.00, '2026-08-08 08:35:37', '2026-08-08 08:35:37', '2026-08-08 08:35:37'),
(913, 31, 31.5200979, 74.3604745, 15.00, 99.66, 18.00, '2026-08-08 08:35:41', '2026-08-08 08:35:41', '2026-08-08 08:35:41'),
(914, 31, 31.5195078, 74.3602633, 15.00, 119.71, 18.00, '2026-08-08 08:35:45', '2026-08-08 08:35:45', '2026-08-08 08:35:45'),
(915, 31, 31.5190258, 74.3598626, 15.00, 139.77, 18.00, '2026-08-08 08:35:49', '2026-08-08 08:35:49', '2026-08-08 08:35:49'),
(916, 31, 31.5187105, 74.3593209, 15.00, 159.82, 18.00, '2026-08-08 08:35:53', '2026-08-08 08:35:53', '2026-08-08 08:35:53'),
(917, 31, 31.5186000, 74.3587039, 15.00, 179.87, 18.00, '2026-08-08 08:35:57', '2026-08-08 08:35:57', '2026-08-08 08:35:57'),
(918, 31, 31.5187078, 74.3580865, 15.00, 199.93, 18.00, '2026-08-08 08:36:01', '2026-08-08 08:36:01', '2026-08-08 08:36:01'),
(919, 31, 31.5190207, 74.3575434, 15.00, 219.98, 18.00, '2026-08-08 08:36:05', '2026-08-08 08:36:05', '2026-08-08 08:36:05'),
(920, 31, 31.5195010, 74.3571406, 15.00, 240.04, 18.00, '2026-08-08 08:36:09', '2026-08-08 08:36:09', '2026-08-08 08:36:09'),
(921, 31, 31.5200902, 74.3569269, 15.00, 260.09, 18.00, '2026-08-08 08:36:13', '2026-08-08 08:36:13', '2026-08-08 08:36:13'),
(922, 31, 31.5207170, 74.3569281, 15.00, 280.14, 18.00, '2026-08-08 08:36:17', '2026-08-08 08:36:17', '2026-08-08 08:36:17'),
(923, 31, 31.5213053, 74.3571442, 15.00, 300.20, 18.00, '2026-08-08 08:36:21', '2026-08-08 08:36:21', '2026-08-08 08:36:21'),
(924, 31, 31.5217839, 74.3575490, 15.00, 320.25, 18.00, '2026-08-08 08:36:25', '2026-08-08 08:36:25', '2026-08-08 08:36:25'),
(925, 31, 31.5220947, 74.3580933, 15.00, 340.30, 18.00, '2026-08-08 08:36:29', '2026-08-08 08:36:29', '2026-08-08 08:36:29'),
(926, 31, 31.5222000, 74.3587112, 15.00, 0.36, 18.00, '2026-08-08 08:36:33', '2026-08-08 08:36:33', '2026-08-08 08:36:33'),
(927, 31, 31.5220870, 74.3593277, 15.00, 20.41, 18.00, '2026-08-08 08:36:37', '2026-08-08 08:36:37', '2026-08-08 08:36:37'),
(928, 31, 31.5217695, 74.3598681, 15.00, 40.46, 18.00, '2026-08-08 08:36:41', '2026-08-08 08:36:41', '2026-08-08 08:36:41'),
(929, 31, 31.5212859, 74.3602669, 15.00, 60.52, 18.00, '2026-08-08 08:36:45', '2026-08-08 08:36:45', '2026-08-08 08:36:45'),
(930, 31, 31.5206949, 74.3604757, 15.00, 80.57, 18.00, '2026-08-08 08:36:49', '2026-08-08 08:36:49', '2026-08-08 08:36:49'),
(931, 31, 31.5200682, 74.3604691, 15.00, 100.62, 18.00, '2026-08-08 08:36:53', '2026-08-08 08:36:53', '2026-08-08 08:36:53'),
(932, 31, 31.5194816, 74.3602481, 15.00, 120.68, 18.00, '2026-08-08 08:36:58', '2026-08-08 08:36:58', '2026-08-08 08:36:58'),
(933, 31, 31.5190065, 74.3598393, 15.00, 140.73, 18.00, '2026-08-08 08:37:02', '2026-08-08 08:37:02', '2026-08-08 08:37:02'),
(934, 31, 31.5187003, 74.3592924, 15.00, 160.78, 18.00, '2026-08-08 08:37:05', '2026-08-08 08:37:05', '2026-08-08 08:37:05'),
(935, 31, 31.5186002, 74.3586737, 15.00, 180.84, 18.00, '2026-08-08 08:37:09', '2026-08-08 08:37:09', '2026-08-08 08:37:09'),
(936, 31, 31.5187183, 74.3580581, 15.00, 200.89, 18.00, '2026-08-08 08:37:13', '2026-08-08 08:37:13', '2026-08-08 08:37:13'),
(937, 31, 31.5190404, 74.3575204, 15.00, 220.94, 18.00, '2026-08-08 08:37:17', '2026-08-08 08:37:17', '2026-08-08 08:37:17'),
(938, 31, 31.5195273, 74.3571257, 15.00, 241.00, 18.00, '2026-08-08 08:37:22', '2026-08-08 08:37:22', '2026-08-08 08:37:22'),
(939, 31, 31.5201200, 74.3569219, 15.00, 261.05, 18.00, '2026-08-08 08:37:26', '2026-08-08 08:37:26', '2026-08-08 08:37:26'),
(940, 31, 31.5207467, 74.3569337, 15.00, 281.11, 18.00, '2026-08-08 08:37:30', '2026-08-08 08:37:30', '2026-08-08 08:37:30'),
(941, 31, 31.5213313, 74.3571597, 15.00, 301.16, 18.00, '2026-08-08 08:37:41', '2026-08-08 08:37:41', '2026-08-08 08:37:41'),
(942, 31, 31.5218031, 74.3575724, 15.00, 321.21, 18.00, '2026-08-08 08:37:44', '2026-08-08 08:37:44', '2026-08-08 08:37:44'),
(943, 31, 31.5221046, 74.3581219, 15.00, 341.27, 18.00, '2026-08-08 08:37:45', '2026-08-08 08:37:45', '2026-08-08 08:37:45'),
(944, 31, 31.5221995, 74.3587415, 15.00, 1.32, 18.00, '2026-08-08 08:37:47', '2026-08-08 08:37:47', '2026-08-08 08:37:47'),
(945, 31, 31.5220762, 74.3593560, 15.00, 21.37, 18.00, '2026-08-08 08:37:51', '2026-08-08 08:37:51', '2026-08-08 08:37:51'),
(946, 31, 31.5217496, 74.3598910, 15.00, 41.43, 18.00, '2026-08-08 08:37:54', '2026-08-08 08:37:54', '2026-08-08 08:37:54'),
(947, 31, 31.5212594, 74.3602816, 15.00, 61.48, 18.00, '2026-08-08 08:37:57', '2026-08-08 08:37:57', '2026-08-08 08:37:57'),
(948, 31, 31.5206650, 74.3604804, 15.00, 81.53, 18.00, '2026-08-08 08:38:02', '2026-08-08 08:38:02', '2026-08-08 08:38:02'),
(949, 31, 31.5200385, 74.3604633, 15.00, 101.59, 18.00, '2026-08-08 08:38:05', '2026-08-08 08:38:05', '2026-08-08 08:38:05'),
(950, 31, 31.5194557, 74.3602324, 15.00, 121.64, 18.00, '2026-08-08 08:38:09', '2026-08-08 08:38:09', '2026-08-08 08:38:09'),
(951, 31, 31.5189875, 74.3598157, 15.00, 141.69, 18.00, '2026-08-08 08:38:13', '2026-08-08 08:38:13', '2026-08-08 08:38:13'),
(952, 31, 31.5186906, 74.3592638, 15.00, 161.75, 18.00, '2026-08-08 08:38:17', '2026-08-08 08:38:17', '2026-08-08 08:38:17'),
(953, 31, 31.5186009, 74.3586434, 15.00, 181.80, 18.00, '2026-08-08 08:38:21', '2026-08-08 08:38:21', '2026-08-08 08:38:21'),
(954, 31, 31.5187294, 74.3580299, 15.00, 201.85, 18.00, '2026-08-08 08:38:25', '2026-08-08 08:38:25', '2026-08-08 08:38:25'),
(955, 31, 31.5190604, 74.3574977, 15.00, 221.91, 18.00, '2026-08-08 08:38:29', '2026-08-08 08:38:29', '2026-08-08 08:38:29'),
(956, 31, 31.5195539, 74.3571113, 15.00, 241.96, 18.00, '2026-08-08 08:38:33', '2026-08-08 08:38:33', '2026-08-08 08:38:33'),
(957, 31, 31.5201500, 74.3569175, 15.00, 262.02, 18.00, '2026-08-08 08:38:37', '2026-08-08 08:38:37', '2026-08-08 08:38:37'),
(958, 31, 31.5207764, 74.3569398, 15.00, 282.07, 18.00, '2026-08-08 08:38:43', '2026-08-08 08:38:43', '2026-08-08 08:38:43'),
(959, 31, 31.5213571, 74.3571756, 15.00, 302.12, 18.00, '2026-08-08 08:38:45', '2026-08-08 08:38:45', '2026-08-08 08:38:45'),
(960, 31, 31.5218218, 74.3575962, 15.00, 322.18, 18.00, '2026-08-08 08:38:49', '2026-08-08 08:38:49', '2026-08-08 08:38:49'),
(961, 31, 31.5221141, 74.3581506, 15.00, 342.23, 18.00, '2026-08-08 08:38:53', '2026-08-08 08:38:53', '2026-08-08 08:38:53'),
(962, 31, 31.5221986, 74.3587717, 15.00, 2.28, 18.00, '2026-08-08 08:38:57', '2026-08-08 08:38:57', '2026-08-08 08:38:57'),
(963, 31, 31.5220649, 74.3593841, 15.00, 22.34, 18.00, '2026-08-08 08:39:01', '2026-08-08 08:39:01', '2026-08-08 08:39:01'),
(964, 31, 31.5217294, 74.3599135, 15.00, 42.39, 18.00, '2026-08-08 08:39:05', '2026-08-08 08:39:05', '2026-08-08 08:39:05'),
(965, 31, 31.5212327, 74.3602958, 15.00, 62.44, 18.00, '2026-08-08 08:39:09', '2026-08-08 08:39:09', '2026-08-08 08:39:09'),
(966, 31, 31.5206350, 74.3604846, 15.00, 82.50, 18.00, '2026-08-08 08:39:13', '2026-08-08 08:39:13', '2026-08-08 08:39:13'),
(967, 31, 31.5200089, 74.3604570, 15.00, 102.55, 18.00, '2026-08-08 08:39:17', '2026-08-08 08:39:17', '2026-08-08 08:39:17'),
(968, 31, 31.5194301, 74.3602163, 15.00, 122.60, 18.00, '2026-08-08 08:39:21', '2026-08-08 08:39:21', '2026-08-08 08:39:21'),
(969, 31, 31.5189690, 74.3597918, 15.00, 142.66, 18.00, '2026-08-08 08:39:25', '2026-08-08 08:39:25', '2026-08-08 08:39:25'),
(970, 31, 31.5186813, 74.3592349, 15.00, 162.71, 18.00, '2026-08-08 08:39:29', '2026-08-08 08:39:29', '2026-08-08 08:39:29'),
(971, 31, 31.5186021, 74.3586132, 15.00, 182.76, 18.00, '2026-08-08 08:39:34', '2026-08-08 08:39:34', '2026-08-08 08:39:34'),
(972, 31, 31.5187409, 74.3580019, 15.00, 202.82, 18.00, '2026-08-08 08:39:39', '2026-08-08 08:39:39', '2026-08-08 08:39:39'),
(973, 31, 31.5190808, 74.3574754, 15.00, 222.87, 18.00, '2026-08-08 08:39:42', '2026-08-08 08:39:42', '2026-08-08 08:39:42'),
(974, 31, 31.5195807, 74.3570973, 15.00, 242.93, 18.00, '2026-08-08 08:39:46', '2026-08-08 08:39:46', '2026-08-08 08:39:46'),
(975, 31, 31.5201800, 74.3569135, 15.00, 262.98, 18.00, '2026-08-08 08:39:53', '2026-08-08 08:39:53', '2026-08-08 08:39:53'),
(976, 31, 31.5208059, 74.3569464, 15.00, 283.03, 18.00, '2026-08-08 08:39:55', '2026-08-08 08:39:55', '2026-08-08 08:39:55'),
(977, 31, 31.5213826, 74.3571919, 15.00, 303.09, 18.00, '2026-08-08 08:39:58', '2026-08-08 08:39:58', '2026-08-08 08:39:58'),
(978, 31, 31.5218402, 74.3576202, 15.00, 323.14, 18.00, '2026-08-08 08:40:02', '2026-08-08 08:40:02', '2026-08-08 08:40:02'),
(979, 31, 31.5221231, 74.3581795, 15.00, 343.19, 18.00, '2026-08-08 08:40:06', '2026-08-08 08:40:06', '2026-08-08 08:40:06'),
(980, 31, 31.5221971, 74.3588019, 15.00, 3.25, 18.00, '2026-08-08 08:40:10', '2026-08-08 08:40:10', '2026-08-08 08:40:10'),
(981, 31, 31.5220532, 74.3594120, 15.00, 23.30, 18.00, '2026-08-08 08:40:14', '2026-08-08 08:40:14', '2026-08-08 08:40:14'),
(982, 31, 31.5217088, 74.3599357, 15.00, 43.35, 18.00, '2026-08-08 08:40:17', '2026-08-08 08:40:17', '2026-08-08 08:40:17'),
(983, 31, 31.5212058, 74.3603096, 15.00, 63.41, 18.00, '2026-08-08 08:40:22', '2026-08-08 08:40:22', '2026-08-08 08:40:22'),
(984, 31, 31.5206050, 74.3604883, 15.00, 83.46, 18.00, '2026-08-08 08:40:26', '2026-08-08 08:40:26', '2026-08-08 08:40:26'),
(985, 31, 31.5199794, 74.3604502, 15.00, 103.51, 18.00, '2026-08-08 08:40:30', '2026-08-08 08:40:30', '2026-08-08 08:40:30'),
(986, 31, 31.5194047, 74.3601998, 15.00, 123.57, 18.00, '2026-08-08 08:40:34', '2026-08-08 08:40:34', '2026-08-08 08:40:34'),
(987, 31, 31.5189508, 74.3597676, 15.00, 143.62, 18.00, '2026-08-08 08:40:39', '2026-08-08 08:40:39', '2026-08-08 08:40:39'),
(988, 31, 31.5186726, 74.3592060, 15.00, 163.67, 18.00, '2026-08-08 08:40:42', '2026-08-08 08:40:42', '2026-08-08 08:40:42'),
(989, 31, 31.5186038, 74.3585830, 15.00, 183.73, 18.00, '2026-08-08 08:40:45', '2026-08-08 08:40:45', '2026-08-08 08:40:45'),
(990, 31, 31.5187528, 74.3579741, 15.00, 203.78, 18.00, '2026-08-08 08:40:50', '2026-08-08 08:40:50', '2026-08-08 08:40:50'),
(991, 31, 31.5191016, 74.3574533, 15.00, 223.84, 18.00, '2026-08-08 08:40:54', '2026-08-08 08:40:54', '2026-08-08 08:40:54'),
(992, 31, 31.5196078, 74.3570837, 15.00, 243.89, 18.00, '2026-08-08 08:40:57', '2026-08-08 08:40:57', '2026-08-08 08:40:57'),
(993, 31, 31.5202100, 74.3569101, 15.00, 263.94, 18.00, '2026-08-08 08:41:01', '2026-08-08 08:41:01', '2026-08-08 08:41:01'),
(994, 31, 31.5208353, 74.3569534, 15.00, 284.00, 18.00, '2026-08-08 08:41:05', '2026-08-08 08:41:05', '2026-08-08 08:41:05'),
(995, 31, 31.5214078, 74.3572086, 15.00, 304.05, 18.00, '2026-08-08 08:41:09', '2026-08-08 08:41:09', '2026-08-08 08:41:09'),
(996, 31, 31.5218581, 74.3576446, 15.00, 324.10, 18.00, '2026-08-08 08:41:13', '2026-08-08 08:41:13', '2026-08-08 08:41:13'),
(997, 31, 31.5221316, 74.3582086, 15.00, 344.16, 18.00, '2026-08-08 08:41:17', '2026-08-08 08:41:17', '2026-08-08 08:41:17'),
(998, 31, 31.5221951, 74.3588321, 15.00, 4.21, 18.00, '2026-08-08 08:41:21', '2026-08-08 08:41:21', '2026-08-08 08:41:21'),
(999, 31, 31.5220410, 74.3594397, 15.00, 24.26, 18.00, '2026-08-08 08:41:25', '2026-08-08 08:41:25', '2026-08-08 08:41:25'),
(1000, 31, 31.5216879, 74.3599575, 15.00, 44.32, 18.00, '2026-08-08 08:41:29', '2026-08-08 08:41:29', '2026-08-08 08:41:29'),
(1001, 31, 31.5211786, 74.3603229, 15.00, 64.37, 18.00, '2026-08-08 08:41:33', '2026-08-08 08:41:33', '2026-08-08 08:41:33'),
(1002, 31, 31.5205749, 74.3604915, 15.00, 84.42, 18.00, '2026-08-08 08:41:37', '2026-08-08 08:41:37', '2026-08-08 08:41:37'),
(1003, 31, 31.5199500, 74.3604428, 15.00, 104.48, 18.00, '2026-08-08 08:41:41', '2026-08-08 08:41:41', '2026-08-08 08:41:41'),
(1004, 31, 31.5193797, 74.3601829, 15.00, 124.53, 18.00, '2026-08-08 08:41:45', '2026-08-08 08:41:45', '2026-08-08 08:41:45'),
(1005, 31, 31.5189331, 74.3597431, 15.00, 144.58, 18.00, '2026-08-08 08:41:49', '2026-08-08 08:41:49', '2026-08-08 08:41:49'),
(1006, 31, 31.5186643, 74.3591768, 15.00, 164.64, 18.00, '2026-08-08 08:41:53', '2026-08-08 08:41:53', '2026-08-08 08:41:53'),
(1007, 31, 31.5186060, 74.3585528, 15.00, 184.69, 18.00, '2026-08-08 08:41:57', '2026-08-08 08:41:57', '2026-08-08 08:41:57'),
(1008, 31, 31.5187653, 74.3579466, 15.00, 204.75, 18.00, '2026-08-08 08:42:01', '2026-08-08 08:42:01', '2026-08-08 08:42:01'),
(1009, 31, 31.5191227, 74.3574317, 15.00, 224.80, 18.00, '2026-08-08 08:42:05', '2026-08-08 08:42:05', '2026-08-08 08:42:05'),
(1010, 31, 31.5196351, 74.3570706, 15.00, 244.85, 18.00, '2026-08-08 08:42:10', '2026-08-08 08:42:10', '2026-08-08 08:42:10'),
(1011, 31, 31.5202402, 74.3569071, 15.00, 264.91, 18.00, '2026-08-08 08:42:13', '2026-08-08 08:42:13', '2026-08-08 08:42:13'),
(1012, 31, 31.5208646, 74.3569610, 15.00, 284.96, 18.00, '2026-08-08 08:42:17', '2026-08-08 08:42:17', '2026-08-08 08:42:17'),
(1013, 31, 31.5214328, 74.3572258, 15.00, 305.01, 18.00, '2026-08-08 08:42:21', '2026-08-08 08:42:21', '2026-08-08 08:42:21'),
(1014, 31, 31.5218757, 74.3576693, 15.00, 325.07, 18.00, '2026-08-08 08:42:25', '2026-08-08 08:42:25', '2026-08-08 08:42:25'),
(1015, 31, 31.5221396, 74.3582378, 15.00, 345.12, 18.00, '2026-08-08 08:42:29', '2026-08-08 08:42:29', '2026-08-08 08:42:29'),
(1016, 31, 31.5221927, 74.3588623, 15.00, 5.17, 18.00, '2026-08-08 08:42:34', '2026-08-08 08:42:34', '2026-08-08 08:42:34'),
(1017, 31, 31.5220283, 74.3594672, 15.00, 25.23, 18.00, '2026-08-08 08:42:37', '2026-08-08 08:42:37', '2026-08-08 08:42:37'),
(1018, 31, 31.5216665, 74.3599790, 15.00, 45.28, 18.00, '2026-08-08 08:42:41', '2026-08-08 08:42:41', '2026-08-08 08:42:41'),
(1019, 31, 31.5211512, 74.3603358, 15.00, 65.33, 18.00, '2026-08-08 08:42:45', '2026-08-08 08:42:45', '2026-08-08 08:42:45'),
(1020, 31, 31.5205448, 74.3604942, 15.00, 85.39, 18.00, '2026-08-08 08:42:49', '2026-08-08 08:42:49', '2026-08-08 08:42:49'),
(1021, 31, 31.5199208, 74.3604350, 15.00, 105.44, 18.00, '2026-08-08 08:42:53', '2026-08-08 08:42:53', '2026-08-08 08:42:53'),
(1022, 31, 31.5193549, 74.3601655, 15.00, 125.49, 18.00, '2026-08-08 08:42:57', '2026-08-08 08:42:57', '2026-08-08 08:42:57'),
(1023, 31, 31.5189157, 74.3597183, 15.00, 145.55, 18.00, '2026-08-08 08:43:01', '2026-08-08 08:43:01', '2026-08-08 08:43:01'),
(1024, 31, 31.5186565, 74.3591476, 15.00, 165.60, 18.00, '2026-08-08 08:43:05', '2026-08-08 08:43:05', '2026-08-08 08:43:05'),
(1025, 31, 31.5186088, 74.3585226, 15.00, 185.65, 18.00, '2026-08-08 08:43:09', '2026-08-08 08:43:09', '2026-08-08 08:43:09'),
(1026, 31, 31.5187782, 74.3579192, 15.00, 205.71, 18.00, '2026-08-08 08:43:14', '2026-08-08 08:43:14', '2026-08-08 08:43:14'),
(1027, 31, 31.5191442, 74.3574104, 15.00, 225.76, 18.00, '2026-08-08 08:43:17', '2026-08-08 08:43:17', '2026-08-08 08:43:17'),
(1028, 31, 31.5196626, 74.3570580, 15.00, 245.82, 18.00, '2026-08-08 08:43:28', '2026-08-08 08:43:28', '2026-08-08 08:43:28'),
(1029, 31, 31.5202703, 74.3569047, 15.00, 265.87, 18.00, '2026-08-08 08:43:31', '2026-08-08 08:43:31', '2026-08-08 08:43:31'),
(1030, 31, 31.5208938, 74.3569691, 15.00, 285.92, 18.00, '2026-08-08 08:43:34', '2026-08-08 08:43:34', '2026-08-08 08:43:34'),
(1031, 31, 31.5214574, 74.3572433, 15.00, 305.98, 18.00, '2026-08-08 08:43:39', '2026-08-08 08:43:39', '2026-08-08 08:43:39'),
(1032, 31, 31.5218928, 74.3576942, 15.00, 326.03, 18.00, '2026-08-08 08:43:45', '2026-08-08 08:43:45', '2026-08-08 08:43:45'),
(1033, 31, 31.5221472, 74.3582671, 15.00, 346.08, 18.00, '2026-08-08 08:43:49', '2026-08-08 08:43:49', '2026-08-08 08:43:49'),
(1034, 31, 31.5221897, 74.3588924, 15.00, 6.14, 18.00, '2026-08-08 08:43:50', '2026-08-08 08:43:50', '2026-08-08 08:43:50'),
(1035, 31, 31.5220152, 74.3594944, 15.00, 26.19, 18.00, '2026-08-08 08:43:53', '2026-08-08 08:43:53', '2026-08-08 08:43:53'),
(1036, 31, 31.5216449, 74.3600001, 15.00, 46.24, 18.00, '2026-08-08 08:43:55', '2026-08-08 08:43:55', '2026-08-08 08:43:55'),
(1037, 31, 31.5211236, 74.3603482, 15.00, 66.30, 18.00, '2026-08-08 08:43:57', '2026-08-08 08:43:57', '2026-08-08 08:43:57'),
(1038, 31, 31.5205146, 74.3604964, 15.00, 86.35, 18.00, '2026-08-08 08:44:01', '2026-08-08 08:44:01', '2026-08-08 08:44:01'),
(1039, 31, 31.5198917, 74.3604267, 15.00, 106.40, 18.00, '2026-08-08 08:44:08', '2026-08-08 08:44:08', '2026-08-08 08:44:08'),
(1040, 31, 31.5193304, 74.3601477, 15.00, 126.46, 18.00, '2026-08-08 08:44:11', '2026-08-08 08:44:11', '2026-08-08 08:44:11'),
(1041, 31, 31.5188988, 74.3596932, 15.00, 146.51, 18.00, '2026-08-08 08:44:13', '2026-08-08 08:44:13', '2026-08-08 08:44:13'),
(1042, 31, 31.5186493, 74.3591182, 15.00, 166.56, 18.00, '2026-08-08 08:44:18', '2026-08-08 08:44:18', '2026-08-08 08:44:18'),
(1043, 31, 31.5186120, 74.3584925, 15.00, 186.62, 18.00, '2026-08-08 08:44:21', '2026-08-08 08:44:21', '2026-08-08 08:44:21'),
(1044, 31, 31.5187915, 74.3578920, 15.00, 206.67, 18.00, '2026-08-08 08:44:25', '2026-08-08 08:44:25', '2026-08-08 08:44:25'),
(1045, 31, 31.5191661, 74.3573895, 15.00, 226.73, 18.00, '2026-08-08 08:44:29', '2026-08-08 08:44:29', '2026-08-08 08:44:29'),
(1046, 31, 31.5196903, 74.3570458, 15.00, 246.78, 18.00, '2026-08-08 08:44:33', '2026-08-08 08:44:33', '2026-08-08 08:44:33'),
(1047, 31, 31.5203005, 74.3569027, 15.00, 266.83, 18.00, '2026-08-08 08:44:37', '2026-08-08 08:44:37', '2026-08-08 08:44:37'),
(1048, 31, 31.5209228, 74.3569776, 15.00, 286.89, 18.00, '2026-08-08 08:44:41', '2026-08-08 08:44:41', '2026-08-08 08:44:41'),
(1049, 31, 31.5214817, 74.3572613, 15.00, 306.94, 18.00, '2026-08-08 08:44:45', '2026-08-08 08:44:45', '2026-08-08 08:44:45'),
(1050, 31, 31.5219095, 74.3577195, 15.00, 326.99, 18.00, '2026-08-08 08:44:51', '2026-08-08 08:44:51', '2026-08-08 08:44:51'),
(1051, 31, 31.5221542, 74.3582965, 15.00, 347.05, 18.00, '2026-08-08 08:44:54', '2026-08-08 08:44:54', '2026-08-08 08:44:54'),
(1052, 31, 31.5221862, 74.3589225, 15.00, 7.10, 18.00, '2026-08-08 08:44:58', '2026-08-08 08:44:58', '2026-08-08 08:44:58'),
(1053, 31, 31.5220016, 74.3595215, 15.00, 27.15, 18.00, '2026-08-08 08:45:01', '2026-08-08 08:45:01', '2026-08-08 08:45:01'),
(1054, 31, 31.5216228, 74.3600209, 15.00, 47.21, 18.00, '2026-08-08 08:45:05', '2026-08-08 08:45:05', '2026-08-08 08:45:05'),
(1055, 31, 31.5210958, 74.3603601, 15.00, 67.26, 18.00, '2026-08-08 08:45:09', '2026-08-08 08:45:09', '2026-08-08 08:45:09'),
(1056, 31, 31.5204843, 74.3604980, 15.00, 87.31, 18.00, '2026-08-08 08:45:14', '2026-08-08 08:45:14', '2026-08-08 08:45:14'),
(1057, 31, 31.5198627, 74.3604179, 15.00, 107.37, 18.00, '2026-08-08 08:45:17', '2026-08-08 08:45:17', '2026-08-08 08:45:17'),
(1058, 31, 31.5193062, 74.3601295, 15.00, 127.42, 18.00, '2026-08-08 08:45:21', '2026-08-08 08:45:21', '2026-08-08 08:45:21'),
(1059, 31, 31.5188823, 74.3596678, 15.00, 147.47, 18.00, '2026-08-08 08:45:25', '2026-08-08 08:45:25', '2026-08-08 08:45:25'),
(1060, 31, 31.5186425, 74.3590887, 15.00, 167.53, 18.00, '2026-08-08 08:45:29', '2026-08-08 08:45:29', '2026-08-08 08:45:29'),
(1061, 31, 31.5186157, 74.3584625, 15.00, 187.58, 18.00, '2026-08-08 08:45:33', '2026-08-08 08:45:33', '2026-08-08 08:45:33'),
(1062, 31, 31.5188053, 74.3578651, 15.00, 207.64, 18.00, '2026-08-08 08:45:37', '2026-08-08 08:45:37', '2026-08-08 08:45:37'),
(1063, 31, 31.5191883, 74.3573689, 15.00, 227.69, 18.00, '2026-08-08 08:45:42', '2026-08-08 08:45:42', '2026-08-08 08:45:42'),
(1064, 31, 31.5197182, 74.3570341, 15.00, 247.74, 18.00, '2026-08-08 08:45:45', '2026-08-08 08:45:45', '2026-08-08 08:45:45'),
(1065, 31, 31.5203308, 74.3569013, 15.00, 267.80, 18.00, '2026-08-08 08:45:49', '2026-08-08 08:45:49', '2026-08-08 08:45:49'),
(1066, 31, 31.5209517, 74.3569866, 15.00, 287.85, 18.00, '2026-08-08 08:45:53', '2026-08-08 08:45:53', '2026-08-08 08:45:53'),
(1067, 31, 31.5215058, 74.3572797, 15.00, 307.90, 18.00, '2026-08-08 08:45:57', '2026-08-08 08:45:57', '2026-08-08 08:45:57'),
(1068, 31, 31.5219258, 74.3577450, 15.00, 327.96, 18.00, '2026-08-08 08:46:01', '2026-08-08 08:46:01', '2026-08-08 08:46:01'),
(1069, 31, 31.5221607, 74.3583261, 15.00, 348.01, 18.00, '2026-08-08 08:46:05', '2026-08-08 08:46:05', '2026-08-08 08:46:05'),
(1070, 31, 31.5221822, 74.3589525, 15.00, 8.06, 18.00, '2026-08-08 08:46:09', '2026-08-08 08:46:09', '2026-08-08 08:46:09'),
(1071, 31, 31.5219876, 74.3595483, 15.00, 28.12, 18.00, '2026-08-08 08:46:13', '2026-08-08 08:46:13', '2026-08-08 08:46:13'),
(1072, 31, 31.5216004, 74.3600412, 15.00, 48.17, 18.00, '2026-08-08 08:46:17', '2026-08-08 08:46:17', '2026-08-08 08:46:17'),
(1073, 31, 31.5210678, 74.3603716, 15.00, 68.22, 18.00, '2026-08-08 08:46:23', '2026-08-08 08:46:23', '2026-08-08 08:46:23'),
(1074, 31, 31.5204541, 74.3604992, 15.00, 88.28, 18.00, '2026-08-08 08:46:25', '2026-08-08 08:46:25', '2026-08-08 08:46:25'),
(1075, 31, 31.5198339, 74.3604087, 15.00, 108.33, 18.00, '2026-08-08 08:46:30', '2026-08-08 08:46:30', '2026-08-08 08:46:30'),
(1076, 31, 31.5192823, 74.3601109, 15.00, 128.38, 18.00, '2026-08-08 08:46:33', '2026-08-08 08:46:33', '2026-08-08 08:46:33'),
(1077, 31, 31.5188663, 74.3596422, 15.00, 148.44, 18.00, '2026-08-08 08:46:37', '2026-08-08 08:46:37', '2026-08-08 08:46:37'),
(1078, 31, 31.5186362, 74.3590591, 15.00, 168.49, 18.00, '2026-08-08 08:46:41', '2026-08-08 08:46:41', '2026-08-08 08:46:41'),
(1079, 31, 31.5186200, 74.3584325, 15.00, 188.55, 18.00, '2026-08-08 08:46:45', '2026-08-08 08:46:45', '2026-08-08 08:46:45'),
(1080, 31, 31.5188196, 74.3578384, 15.00, 208.60, 18.00, '2026-08-08 08:46:49', '2026-08-08 08:46:49', '2026-08-08 08:46:49'),
(1081, 31, 31.5192109, 74.3573487, 15.00, 228.65, 18.00, '2026-08-08 08:46:53', '2026-08-08 08:46:53', '2026-08-08 08:46:53'),
(1082, 31, 31.5197463, 74.3570229, 15.00, 248.71, 18.00, '2026-08-08 08:46:57', '2026-08-08 08:46:57', '2026-08-08 08:46:57'),
(1083, 31, 31.5203610, 74.3569004, 15.00, 268.76, 18.00, '2026-08-08 08:47:01', '2026-08-08 08:47:01', '2026-08-08 08:47:01'),
(1084, 31, 31.5209805, 74.3569962, 15.00, 288.81, 18.00, '2026-08-08 08:47:05', '2026-08-08 08:47:05', '2026-08-08 08:47:05'),
(1085, 31, 31.5215295, 74.3572985, 15.00, 308.87, 18.00, '2026-08-08 08:47:09', '2026-08-08 08:47:09', '2026-08-08 08:47:09'),
(1086, 31, 31.5219416, 74.3577708, 15.00, 328.92, 18.00, '2026-08-08 08:47:13', '2026-08-08 08:47:13', '2026-08-08 08:47:13'),
(1087, 31, 31.5221668, 74.3583557, 15.00, 348.97, 18.00, '2026-08-08 08:47:17', '2026-08-08 08:47:17', '2026-08-08 08:47:17'),
(1088, 31, 31.5221777, 74.3589824, 15.00, 9.03, 18.00, '2026-08-08 08:47:21', '2026-08-08 08:47:21', '2026-08-08 08:47:21'),
(1089, 31, 31.5219731, 74.3595749, 15.00, 29.08, 18.00, '2026-08-08 08:47:26', '2026-08-08 08:47:26', '2026-08-08 08:47:26'),
(1090, 31, 31.5215777, 74.3600612, 15.00, 49.13, 18.00, '2026-08-08 08:47:29', '2026-08-08 08:47:29', '2026-08-08 08:47:29'),
(1091, 31, 31.5210396, 74.3603825, 15.00, 69.19, 18.00, '2026-08-08 08:47:33', '2026-08-08 08:47:33', '2026-08-08 08:47:33'),
(1092, 31, 31.5204238, 74.3604998, 15.00, 89.24, 18.00, '2026-08-08 08:47:39', '2026-08-08 08:47:39', '2026-08-08 08:47:39'),
(1093, 31, 31.5198052, 74.3603989, 15.00, 109.29, 18.00, '2026-08-08 08:47:41', '2026-08-08 08:47:41', '2026-08-08 08:47:41'),
(1094, 31, 31.5192587, 74.3600920, 15.00, 129.35, 18.00, '2026-08-08 08:47:47', '2026-08-08 08:47:47', '2026-08-08 08:47:47'),
(1095, 31, 31.5188506, 74.3596162, 15.00, 149.40, 18.00, '2026-08-08 08:47:49', '2026-08-08 08:47:49', '2026-08-08 08:47:49'),
(1096, 31, 31.5186304, 74.3590294, 15.00, 169.46, 18.00, '2026-08-08 08:47:55', '2026-08-08 08:47:55', '2026-08-08 08:47:55'),
(1097, 31, 31.5186247, 74.3584026, 15.00, 189.51, 18.00, '2026-08-08 08:47:58', '2026-08-08 08:47:58', '2026-08-08 08:47:58'),
(1098, 31, 31.5188343, 74.3578119, 15.00, 209.56, 18.00, '2026-08-08 08:48:02', '2026-08-08 08:48:02', '2026-08-08 08:48:02'),
(1099, 31, 31.5192338, 74.3573289, 15.00, 229.62, 18.00, '2026-08-08 08:48:05', '2026-08-08 08:48:05', '2026-08-08 08:48:05'),
(1100, 31, 31.5197746, 74.3570121, 15.00, 249.67, 18.00, '2026-08-08 08:48:09', '2026-08-08 08:48:09', '2026-08-08 08:48:09'),
(1101, 31, 31.5203913, 74.3569000, 15.00, 269.72, 18.00, '2026-08-08 08:48:14', '2026-08-08 08:48:14', '2026-08-08 08:48:14'),
(1102, 31, 31.5210090, 74.3570062, 15.00, 289.78, 18.00, '2026-08-08 08:48:17', '2026-08-08 08:48:17', '2026-08-08 08:48:17'),
(1103, 31, 31.5215529, 74.3573177, 15.00, 309.83, 18.00, '2026-08-08 08:48:21', '2026-08-08 08:48:21', '2026-08-08 08:48:21'),
(1104, 31, 31.5219570, 74.3577968, 15.00, 329.88, 18.00, '2026-08-08 08:48:25', '2026-08-08 08:48:25', '2026-08-08 08:48:25'),
(1105, 31, 31.5221723, 74.3583855, 15.00, 349.94, 18.00, '2026-08-08 08:48:29', '2026-08-08 08:48:29', '2026-08-08 08:48:29'),
(1106, 31, 31.5221727, 74.3590123, 15.00, 9.99, 18.00, '2026-08-08 08:48:33', '2026-08-08 08:48:33', '2026-08-08 08:48:33'),
(1107, 31, 31.5219582, 74.3596012, 15.00, 30.04, 18.00, '2026-08-08 08:48:37', '2026-08-08 08:48:37', '2026-08-08 08:48:37'),
(1108, 31, 31.5215547, 74.3600808, 15.00, 50.10, 18.00, '2026-08-08 08:48:41', '2026-08-08 08:48:41', '2026-08-08 08:48:41'),
(1109, 31, 31.5210112, 74.3603931, 15.00, 70.15, 18.00, '2026-08-08 08:48:45', '2026-08-08 08:48:45', '2026-08-08 08:48:45'),
(1110, 31, 31.5203936, 74.3605000, 15.00, 90.20, 18.00, '2026-08-08 08:48:49', '2026-08-08 08:48:49', '2026-08-08 08:48:49'),
(1111, 31, 31.5197768, 74.3603887, 15.00, 110.26, 18.00, '2026-08-08 08:48:53', '2026-08-08 08:48:53', '2026-08-08 08:48:53'),
(1112, 31, 31.5192355, 74.3600726, 15.00, 130.31, 18.00, '2026-08-08 08:48:57', '2026-08-08 08:48:57', '2026-08-08 08:48:57'),
(1113, 31, 31.5188355, 74.3595901, 15.00, 150.36, 18.00, '2026-08-08 08:49:01', '2026-08-08 08:49:01', '2026-08-08 08:49:01'),
(1114, 31, 31.5186251, 74.3589996, 15.00, 170.42, 18.00, '2026-08-08 08:49:05', '2026-08-08 08:49:05', '2026-08-08 08:49:05'),
(1115, 31, 31.5186300, 74.3583728, 15.00, 190.47, 18.00, '2026-08-08 08:49:09', '2026-08-08 08:49:09', '2026-08-08 08:49:09'),
(1116, 31, 31.5188495, 74.3577857, 15.00, 210.53, 18.00, '2026-08-08 08:49:13', '2026-08-08 08:49:13', '2026-08-08 08:49:13'),
(1117, 31, 31.5192570, 74.3573095, 15.00, 230.58, 18.00, '2026-08-08 08:49:17', '2026-08-08 08:49:17', '2026-08-08 08:49:17'),
(1118, 31, 31.5198031, 74.3570019, 15.00, 250.63, 18.00, '2026-08-08 08:49:21', '2026-08-08 08:49:21', '2026-08-08 08:49:21'),
(1119, 31, 31.5204216, 74.3569001, 15.00, 270.69, 18.00, '2026-08-08 08:49:25', '2026-08-08 08:49:25', '2026-08-08 08:49:25'),
(1120, 31, 31.5210374, 74.3570166, 15.00, 290.74, 18.00, '2026-08-08 08:49:29', '2026-08-08 08:49:29', '2026-08-08 08:49:29'),
(1121, 31, 31.5215760, 74.3573373, 15.00, 310.79, 18.00, '2026-08-08 08:49:33', '2026-08-08 08:49:33', '2026-08-08 08:49:33'),
(1122, 31, 31.5219720, 74.3578231, 15.00, 330.85, 18.00, '2026-08-08 08:49:38', '2026-08-08 08:49:38', '2026-08-08 08:49:38'),
(1123, 31, 31.5221773, 74.3584153, 15.00, 350.90, 18.00, '2026-08-08 08:49:41', '2026-08-08 08:49:41', '2026-08-08 08:49:41'),
(1124, 31, 31.5221672, 74.3590420, 15.00, 10.95, 18.00, '2026-08-08 08:49:45', '2026-08-08 08:49:45', '2026-08-08 08:49:45'),
(1125, 31, 31.5219428, 74.3596273, 15.00, 31.01, 18.00, '2026-08-08 08:49:49', '2026-08-08 08:49:49', '2026-08-08 08:49:49'),
(1126, 31, 31.5215313, 74.3601001, 15.00, 51.06, 18.00, '2026-08-08 08:49:53', '2026-08-08 08:49:53', '2026-08-08 08:49:53'),
(1127, 31, 31.5209826, 74.3604031, 15.00, 71.11, 18.00, '2026-08-08 08:49:57', '2026-08-08 08:49:57', '2026-08-08 08:49:57'),
(1128, 31, 31.5203633, 74.3604996, 15.00, 91.17, 18.00, '2026-08-08 08:50:01', '2026-08-08 08:50:01', '2026-08-08 08:50:01'),
(1129, 31, 31.5197485, 74.3603779, 15.00, 111.22, 18.00, '2026-08-08 08:50:05', '2026-08-08 08:50:05', '2026-08-08 08:50:05'),
(1130, 31, 31.5192126, 74.3600528, 15.00, 131.27, 18.00, '2026-08-08 08:50:09', '2026-08-08 08:50:09', '2026-08-08 08:50:09'),
(1131, 31, 31.5188207, 74.3595636, 15.00, 151.33, 18.00, '2026-08-08 08:50:13', '2026-08-08 08:50:13', '2026-08-08 08:50:13'),
(1132, 31, 31.5186203, 74.3589697, 15.00, 171.38, 18.00, '2026-08-08 08:50:17', '2026-08-08 08:50:17', '2026-08-08 08:50:17'),
(1133, 31, 31.5186357, 74.3583431, 15.00, 191.44, 18.00, '2026-08-08 08:50:21', '2026-08-08 08:50:21', '2026-08-08 08:50:21'),
(1134, 31, 31.5188651, 74.3577598, 15.00, 211.49, 18.00, '2026-08-08 08:50:25', '2026-08-08 08:50:25', '2026-08-08 08:50:25'),
(1135, 31, 31.5192805, 74.3572905, 15.00, 231.54, 18.00, '2026-08-08 08:50:29', '2026-08-08 08:50:29', '2026-08-08 08:50:29'),
(1136, 31, 31.5198317, 74.3569921, 15.00, 251.60, 18.00, '2026-08-08 08:50:33', '2026-08-08 08:50:33', '2026-08-08 08:50:33'),
(1137, 31, 31.5204518, 74.3569007, 15.00, 271.65, 18.00, '2026-08-08 08:50:37', '2026-08-08 08:50:37', '2026-08-08 08:50:37'),
(1138, 31, 31.5210656, 74.3570276, 15.00, 291.70, 18.00, '2026-08-08 08:50:41', '2026-08-08 08:50:41', '2026-08-08 08:50:41'),
(1139, 31, 31.5215987, 74.3573572, 15.00, 311.76, 18.00, '2026-08-08 08:50:45', '2026-08-08 08:50:45', '2026-08-08 08:50:45'),
(1140, 31, 31.5219865, 74.3578497, 15.00, 331.81, 18.00, '2026-08-08 08:50:49', '2026-08-08 08:50:49', '2026-08-08 08:50:49'),
(1141, 31, 31.5221819, 74.3584452, 15.00, 351.86, 18.00, '2026-08-08 08:50:53', '2026-08-08 08:50:53', '2026-08-08 08:50:53'),
(1142, 31, 31.5221612, 74.3590717, 15.00, 11.92, 18.00, '2026-08-08 08:50:57', '2026-08-08 08:50:57', '2026-08-08 08:50:57'),
(1143, 31, 31.5219270, 74.3596531, 15.00, 31.97, 18.00, '2026-08-08 08:51:01', '2026-08-08 08:51:01', '2026-08-08 08:51:01'),
(1144, 31, 31.5215076, 74.3601189, 15.00, 52.02, 18.00, '2026-08-08 08:51:05', '2026-08-08 08:51:05', '2026-08-08 08:51:05'),
(1145, 31, 31.5209539, 74.3604127, 15.00, 72.08, 18.00, '2026-08-08 08:51:09', '2026-08-08 08:51:09', '2026-08-08 08:51:09'),
(1146, 31, 31.5203331, 74.3604988, 15.00, 92.13, 18.00, '2026-08-08 08:51:13', '2026-08-08 08:51:13', '2026-08-08 08:51:13'),
(1147, 31, 31.5197203, 74.3603667, 15.00, 112.18, 18.00, '2026-08-08 08:51:17', '2026-08-08 08:51:17', '2026-08-08 08:51:17'),
(1148, 31, 31.5191900, 74.3600326, 15.00, 132.24, 18.00, '2026-08-08 08:51:21', '2026-08-08 08:51:21', '2026-08-08 08:51:21'),
(1149, 31, 31.5188064, 74.3595369, 15.00, 152.29, 18.00, '2026-08-08 08:51:25', '2026-08-08 08:51:25', '2026-08-08 08:51:25'),
(1150, 31, 31.5186160, 74.3589398, 15.00, 172.35, 18.00, '2026-08-08 08:51:30', '2026-08-08 08:51:30', '2026-08-08 08:51:30'),
(1151, 31, 31.5186420, 74.3583135, 15.00, 192.40, 18.00, '2026-08-08 08:51:33', '2026-08-08 08:51:33', '2026-08-08 08:51:33'),
(1152, 31, 31.5188811, 74.3577341, 15.00, 212.45, 18.00, '2026-08-08 08:51:37', '2026-08-08 08:51:37', '2026-08-08 08:51:37'),
(1153, 31, 31.5193044, 74.3572719, 15.00, 232.51, 18.00, '2026-08-08 08:51:41', '2026-08-08 08:51:41', '2026-08-08 08:51:41'),
(1154, 31, 31.5198605, 74.3569827, 15.00, 252.56, 18.00, '2026-08-08 08:51:45', '2026-08-08 08:51:45', '2026-08-08 08:51:45'),
(1155, 31, 31.5204821, 74.3569019, 15.00, 272.61, 18.00, '2026-08-08 08:51:49', '2026-08-08 08:51:49', '2026-08-08 08:51:49'),
(1156, 31, 31.5210937, 74.3570390, 15.00, 292.67, 18.00, '2026-08-08 08:51:53', '2026-08-08 08:51:53', '2026-08-08 08:51:53'),
(1157, 31, 31.5216211, 74.3573776, 15.00, 312.72, 18.00, '2026-08-08 08:51:57', '2026-08-08 08:51:57', '2026-08-08 08:51:57'),
(1158, 31, 31.5220006, 74.3578765, 15.00, 332.77, 18.00, '2026-08-08 08:52:01', '2026-08-08 08:52:01', '2026-08-08 08:52:01'),
(1159, 31, 31.5221859, 74.3584752, 15.00, 352.83, 18.00, '2026-08-08 08:52:05', '2026-08-08 08:52:05', '2026-08-08 08:52:05'),
(1160, 31, 31.5221547, 74.3591013, 15.00, 12.88, 18.00, '2026-08-08 08:52:09', '2026-08-08 08:52:09', '2026-08-08 08:52:09'),
(1161, 31, 31.5219107, 74.3596786, 15.00, 32.93, 18.00, '2026-08-08 08:52:13', '2026-08-08 08:52:13', '2026-08-08 08:52:13'),
(1162, 31, 31.5214836, 74.3601373, 15.00, 52.99, 18.00, '2026-08-08 08:52:17', '2026-08-08 08:52:17', '2026-08-08 08:52:17'),
(1163, 31, 31.5209250, 74.3604217, 15.00, 73.04, 18.00, '2026-08-08 08:52:21', '2026-08-08 08:52:21', '2026-08-08 08:52:21'),
(1164, 31, 31.5203028, 74.3604974, 15.00, 93.09, 18.00, '2026-08-08 08:52:25', '2026-08-08 08:52:25', '2026-08-08 08:52:25'),
(1165, 31, 31.5196924, 74.3603551, 15.00, 113.15, 18.00, '2026-08-08 08:52:29', '2026-08-08 08:52:29', '2026-08-08 08:52:29'),
(1166, 31, 31.5191678, 74.3600121, 15.00, 133.20, 18.00, '2026-08-08 08:52:33', '2026-08-08 08:52:33', '2026-08-08 08:52:33'),
(1167, 31, 31.5187926, 74.3595100, 15.00, 153.26, 18.00, '2026-08-08 08:52:37', '2026-08-08 08:52:37', '2026-08-08 08:52:37'),
(1168, 31, 31.5186123, 74.3589097, 15.00, 173.31, 18.00, '2026-08-08 08:52:41', '2026-08-08 08:52:41', '2026-08-08 08:52:41'),
(1169, 31, 31.5186487, 74.3582840, 15.00, 193.36, 18.00, '2026-08-08 08:52:45', '2026-08-08 08:52:45', '2026-08-08 08:52:45'),
(1170, 31, 31.5188975, 74.3577087, 15.00, 213.42, 18.00, '2026-08-08 08:52:49', '2026-08-08 08:52:49', '2026-08-08 08:52:49'),
(1171, 31, 31.5193285, 74.3572536, 15.00, 233.47, 18.00, '2026-08-08 08:52:53', '2026-08-08 08:52:53', '2026-08-08 08:52:53'),
(1172, 31, 31.5198895, 74.3569739, 15.00, 253.52, 18.00, '2026-08-08 08:52:57', '2026-08-08 08:52:57', '2026-08-08 08:52:57'),
(1173, 31, 31.5205123, 74.3569035, 15.00, 273.58, 18.00, '2026-08-08 08:53:01', '2026-08-08 08:53:01', '2026-08-08 08:53:01'),
(1174, 31, 31.5211215, 74.3570509, 15.00, 293.63, 18.00, '2026-08-08 08:53:05', '2026-08-08 08:53:05', '2026-08-08 08:53:05'),
(1175, 31, 31.5216432, 74.3573983, 15.00, 313.68, 18.00, '2026-08-08 08:53:09', '2026-08-08 08:53:09', '2026-08-08 08:53:09'),
(1176, 31, 31.5220142, 74.3579035, 15.00, 333.74, 18.00, '2026-08-08 08:53:13', '2026-08-08 08:53:13', '2026-08-08 08:53:13'),
(1177, 31, 31.5221894, 74.3585053, 15.00, 353.79, 18.00, '2026-08-08 08:53:17', '2026-08-08 08:53:17', '2026-08-08 08:53:17'),
(1178, 31, 31.5221477, 74.3591307, 15.00, 13.84, 18.00, '2026-08-08 08:53:21', '2026-08-08 08:53:21', '2026-08-08 08:53:21'),
(1179, 31, 31.5218941, 74.3597039, 15.00, 33.90, 18.00, '2026-08-08 08:53:25', '2026-08-08 08:53:25', '2026-08-08 08:53:25'),
(1180, 31, 31.5214593, 74.3601553, 15.00, 53.95, 18.00, '2026-08-08 08:53:29', '2026-08-08 08:53:29', '2026-08-08 08:53:29'),
(1181, 31, 31.5208960, 74.3604303, 15.00, 74.00, 18.00, '2026-08-08 08:53:33', '2026-08-08 08:53:33', '2026-08-08 08:53:33'),
(1182, 31, 31.5202726, 74.3604955, 15.00, 94.06, 18.00, '2026-08-08 08:53:37', '2026-08-08 08:53:37', '2026-08-08 08:53:37'),
(1183, 31, 31.5196647, 74.3603430, 15.00, 114.11, 18.00, '2026-08-08 08:53:47', '2026-08-08 08:53:47', '2026-08-08 08:53:47'),
(1184, 31, 31.5191459, 74.3599912, 15.00, 134.17, 18.00, '2026-08-08 08:53:48', '2026-08-08 08:53:48', '2026-08-08 08:53:48'),
(1185, 31, 31.5187792, 74.3594829, 15.00, 154.22, 18.00, '2026-08-08 08:53:50', '2026-08-08 08:53:50', '2026-08-08 08:53:50'),
(1186, 31, 31.5186090, 74.3588796, 15.00, 174.27, 18.00, '2026-08-08 08:53:53', '2026-08-08 08:53:53', '2026-08-08 08:53:53'),
(1187, 31, 31.5186560, 74.3582546, 15.00, 194.33, 18.00, '2026-08-08 08:53:57', '2026-08-08 08:53:57', '2026-08-08 08:53:57'),
(1188, 31, 31.5189144, 74.3576836, 15.00, 214.38, 18.00, '2026-08-08 08:54:01', '2026-08-08 08:54:01', '2026-08-08 08:54:01'),
(1189, 31, 31.5193530, 74.3572358, 15.00, 234.43, 18.00, '2026-08-08 08:54:05', '2026-08-08 08:54:05', '2026-08-08 08:54:05'),
(1190, 31, 31.5199186, 74.3569656, 15.00, 254.49, 18.00, '2026-08-08 08:54:09', '2026-08-08 08:54:09', '2026-08-08 08:54:09'),
(1191, 31, 31.5205425, 74.3569056, 15.00, 274.54, 18.00, '2026-08-08 08:54:13', '2026-08-08 08:54:13', '2026-08-08 08:54:13'),
(1192, 31, 31.5211491, 74.3570633, 15.00, 294.59, 18.00, '2026-08-08 08:54:17', '2026-08-08 08:54:17', '2026-08-08 08:54:17'),
(1193, 31, 31.5216649, 74.3574194, 15.00, 314.65, 18.00, '2026-08-08 08:54:21', '2026-08-08 08:54:21', '2026-08-08 08:54:21'),
(1194, 31, 31.5220274, 74.3579308, 15.00, 334.70, 18.00, '2026-08-08 08:54:25', '2026-08-08 08:54:25', '2026-08-08 08:54:25'),
(1195, 31, 31.5221925, 74.3585354, 15.00, 354.75, 18.00, '2026-08-08 08:54:29', '2026-08-08 08:54:29', '2026-08-08 08:54:29'),
(1196, 31, 31.5221402, 74.3591600, 15.00, 14.81, 18.00, '2026-08-08 08:54:33', '2026-08-08 08:54:33', '2026-08-08 08:54:33'),
(1197, 31, 31.5218770, 74.3597289, 15.00, 34.86, 18.00, '2026-08-08 08:54:37', '2026-08-08 08:54:37', '2026-08-08 08:54:37'),
(1198, 31, 31.5214346, 74.3601729, 15.00, 54.91, 18.00, '2026-08-08 08:54:41', '2026-08-08 08:54:41', '2026-08-08 08:54:41'),
(1199, 31, 31.5208668, 74.3604384, 15.00, 74.97, 18.00, '2026-08-08 08:54:46', '2026-08-08 08:54:46', '2026-08-08 08:54:46'),
(1200, 31, 31.5202424, 74.3604931, 15.00, 95.02, 18.00, '2026-08-08 08:54:49', '2026-08-08 08:54:49', '2026-08-08 08:54:49'),
(1201, 31, 31.5196372, 74.3603304, 15.00, 115.07, 18.00, '2026-08-08 08:54:53', '2026-08-08 08:54:53', '2026-08-08 08:54:53'),
(1202, 31, 31.5191244, 74.3599699, 15.00, 135.13, 18.00, '2026-08-08 08:54:57', '2026-08-08 08:54:57', '2026-08-08 08:54:57'),
(1203, 31, 31.5187662, 74.3594555, 15.00, 155.18, 18.00, '2026-08-08 08:55:01', '2026-08-08 08:55:01', '2026-08-08 08:55:01'),
(1204, 31, 31.5186062, 74.3588495, 15.00, 175.24, 18.00, '2026-08-08 08:55:05', '2026-08-08 08:55:05', '2026-08-08 08:55:05'),
(1205, 31, 31.5186637, 74.3582254, 15.00, 195.29, 18.00, '2026-08-08 08:55:09', '2026-08-08 08:55:09', '2026-08-08 08:55:09'),
(1206, 31, 31.5189317, 74.3576588, 15.00, 215.34, 18.00, '2026-08-08 08:55:13', '2026-08-08 08:55:13', '2026-08-08 08:55:13'),
(1207, 31, 31.5193778, 74.3572184, 15.00, 235.40, 18.00, '2026-08-08 08:55:19', '2026-08-08 08:55:19', '2026-08-08 08:55:19'),
(1208, 31, 31.5199478, 74.3569577, 15.00, 255.45, 18.00, '2026-08-08 08:55:23', '2026-08-08 08:55:23', '2026-08-08 08:55:23'),
(1209, 31, 31.5205726, 74.3569083, 15.00, 275.50, 18.00, '2026-08-08 08:55:25', '2026-08-08 08:55:25', '2026-08-08 08:55:25'),
(1210, 31, 31.5211765, 74.3570761, 15.00, 295.56, 18.00, '2026-08-08 08:55:29', '2026-08-08 08:55:29', '2026-08-08 08:55:29'),
(1211, 31, 31.5216863, 74.3574408, 15.00, 315.61, 18.00, '2026-08-08 08:55:33', '2026-08-08 08:55:33', '2026-08-08 08:55:33'),
(1212, 31, 31.5220401, 74.3579582, 15.00, 335.66, 18.00, '2026-08-08 08:55:37', '2026-08-08 08:55:37', '2026-08-08 08:55:37');
INSERT INTO `trip_locations` (`id`, `trip_id`, `latitude`, `longitude`, `accuracy`, `heading`, `speed`, `recorded_at`, `created_at`, `updated_at`) VALUES
(1213, 31, 31.5221950, 74.3585656, 15.00, 355.72, 18.00, '2026-08-08 08:55:41', '2026-08-08 08:55:41', '2026-08-08 08:55:41'),
(1214, 31, 31.5221322, 74.3591892, 15.00, 15.77, 18.00, '2026-08-08 08:55:46', '2026-08-08 08:55:46', '2026-08-08 08:55:46'),
(1215, 31, 31.5218595, 74.3597535, 15.00, 35.82, 18.00, '2026-08-08 08:55:50', '2026-08-08 08:55:50', '2026-08-08 08:55:50'),
(1216, 31, 31.5214097, 74.3601901, 15.00, 55.88, 18.00, '2026-08-08 08:55:53', '2026-08-08 08:55:53', '2026-08-08 08:55:53'),
(1217, 31, 31.5208376, 74.3604460, 15.00, 75.93, 18.00, '2026-08-08 08:55:57', '2026-08-08 08:55:57', '2026-08-08 08:55:57'),
(1218, 31, 31.5202123, 74.3604902, 15.00, 95.98, 18.00, '2026-08-08 08:56:01', '2026-08-08 08:56:01', '2026-08-08 08:56:01'),
(1219, 31, 31.5196098, 74.3603173, 15.00, 116.04, 18.00, '2026-08-08 08:56:05', '2026-08-08 08:56:05', '2026-08-08 08:56:05'),
(1220, 31, 31.5191032, 74.3599483, 15.00, 136.09, 18.00, '2026-08-08 08:56:09', '2026-08-08 08:56:09', '2026-08-08 08:56:09'),
(1221, 31, 31.5187538, 74.3594279, 15.00, 156.15, 18.00, '2026-08-08 08:56:13', '2026-08-08 08:56:13', '2026-08-08 08:56:13'),
(1222, 31, 31.5186040, 74.3588193, 15.00, 176.20, 18.00, '2026-08-08 08:56:17', '2026-08-08 08:56:17', '2026-08-08 08:56:17'),
(1223, 31, 31.5186719, 74.3581962, 15.00, 196.25, 18.00, '2026-08-08 08:56:21', '2026-08-08 08:56:21', '2026-08-08 08:56:21'),
(1224, 31, 31.5189494, 74.3576342, 15.00, 216.31, 18.00, '2026-08-08 08:56:25', '2026-08-08 08:56:25', '2026-08-08 08:56:25'),
(1225, 31, 31.5194028, 74.3572014, 15.00, 236.36, 18.00, '2026-08-08 08:56:30', '2026-08-08 08:56:30', '2026-08-08 08:56:30'),
(1226, 31, 31.5199771, 74.3569504, 15.00, 256.41, 18.00, '2026-08-08 08:56:33', '2026-08-08 08:56:33', '2026-08-08 08:56:33'),
(1227, 31, 31.5206027, 74.3569115, 15.00, 276.47, 18.00, '2026-08-08 08:56:37', '2026-08-08 08:56:37', '2026-08-08 08:56:37'),
(1228, 31, 31.5212037, 74.3570894, 15.00, 296.52, 18.00, '2026-08-08 08:56:41', '2026-08-08 08:56:41', '2026-08-08 08:56:41'),
(1229, 31, 31.5217073, 74.3574626, 15.00, 316.57, 18.00, '2026-08-08 08:56:45', '2026-08-08 08:56:45', '2026-08-08 08:56:45'),
(1230, 31, 31.5220523, 74.3579859, 15.00, 336.63, 18.00, '2026-08-08 08:56:49', '2026-08-08 08:56:49', '2026-08-08 08:56:49'),
(1231, 31, 31.5221970, 74.3585958, 15.00, 356.68, 18.00, '2026-08-08 08:56:53', '2026-08-08 08:56:53', '2026-08-08 08:56:53'),
(1232, 31, 31.5221238, 74.3592183, 15.00, 16.73, 18.00, '2026-08-08 08:56:57', '2026-08-08 08:56:57', '2026-08-08 08:56:57'),
(1233, 31, 31.5218415, 74.3597779, 15.00, 36.79, 18.00, '2026-08-08 08:57:01', '2026-08-08 08:57:01', '2026-08-08 08:57:01'),
(1234, 31, 31.5213845, 74.3602069, 15.00, 56.84, 18.00, '2026-08-08 08:57:05', '2026-08-08 08:57:05', '2026-08-08 08:57:05'),
(1235, 31, 31.5208081, 74.3604531, 15.00, 76.89, 18.00, '2026-08-08 08:57:09', '2026-08-08 08:57:09', '2026-08-08 08:57:09'),
(1236, 31, 31.5201822, 74.3604868, 15.00, 96.95, 18.00, '2026-08-08 08:57:13', '2026-08-08 08:57:13', '2026-08-08 08:57:13'),
(1237, 31, 31.5195828, 74.3603038, 15.00, 117.00, 18.00, '2026-08-08 08:57:17', '2026-08-08 08:57:17', '2026-08-08 08:57:17'),
(1238, 31, 31.5190824, 74.3599263, 15.00, 137.06, 18.00, '2026-08-08 08:57:21', '2026-08-08 08:57:21', '2026-08-08 08:57:21'),
(1239, 31, 31.5187418, 74.3594002, 15.00, 157.11, 18.00, '2026-08-08 08:57:25', '2026-08-08 08:57:25', '2026-08-08 08:57:25'),
(1240, 31, 31.5186022, 74.3587891, 15.00, 177.16, 18.00, '2026-08-08 08:57:29', '2026-08-08 08:57:29', '2026-08-08 08:57:29'),
(1241, 31, 31.5186806, 74.3581672, 15.00, 197.22, 18.00, '2026-08-08 08:57:34', '2026-08-08 08:57:34', '2026-08-08 08:57:34'),
(1242, 31, 31.5189676, 74.3576100, 15.00, 217.27, 18.00, '2026-08-08 08:57:38', '2026-08-08 08:57:38', '2026-08-08 08:57:38'),
(1243, 31, 31.5194282, 74.3571849, 15.00, 237.32, 18.00, '2026-08-08 08:57:41', '2026-08-08 08:57:41', '2026-08-08 08:57:41'),
(1244, 31, 31.5200066, 74.3569435, 15.00, 257.38, 18.00, '2026-08-08 08:57:45', '2026-08-08 08:57:45', '2026-08-08 08:57:45'),
(1245, 31, 31.5206328, 74.3569151, 15.00, 277.43, 18.00, '2026-08-08 08:57:49', '2026-08-08 08:57:49', '2026-08-08 08:57:49'),
(1246, 31, 31.5212307, 74.3571031, 15.00, 297.48, 18.00, '2026-08-08 08:57:54', '2026-08-08 08:57:54', '2026-08-08 08:57:54'),
(1247, 31, 31.5217279, 74.3574848, 15.00, 317.54, 18.00, '2026-08-08 08:57:57', '2026-08-08 08:57:57', '2026-08-08 08:57:57'),
(1248, 31, 31.5220641, 74.3580138, 15.00, 337.59, 18.00, '2026-08-08 08:58:01', '2026-08-08 08:58:01', '2026-08-08 08:58:01'),
(1249, 31, 31.5221985, 74.3586260, 15.00, 357.64, 18.00, '2026-08-08 08:58:05', '2026-08-08 08:58:05', '2026-08-08 08:58:05'),
(1250, 31, 31.5221148, 74.3592472, 15.00, 17.70, 18.00, '2026-08-08 08:58:09', '2026-08-08 08:58:09', '2026-08-08 08:58:09'),
(1251, 31, 31.5218232, 74.3598020, 15.00, 37.75, 18.00, '2026-08-08 08:58:13', '2026-08-08 08:58:13', '2026-08-08 08:58:13'),
(1252, 31, 31.5213591, 74.3602232, 15.00, 57.80, 18.00, '2026-08-08 08:58:17', '2026-08-08 08:58:17', '2026-08-08 08:58:17'),
(1253, 31, 31.5207786, 74.3604597, 15.00, 77.86, 18.00, '2026-08-08 08:58:21', '2026-08-08 08:58:21', '2026-08-08 08:58:21'),
(1254, 31, 31.5201522, 74.3604829, 15.00, 97.91, 18.00, '2026-08-08 08:58:25', '2026-08-08 08:58:25', '2026-08-08 08:58:25'),
(1255, 31, 31.5195559, 74.3602898, 15.00, 117.97, 18.00, '2026-08-08 08:58:29', '2026-08-08 08:58:29', '2026-08-08 08:58:29'),
(1256, 31, 31.5190619, 74.3599040, 15.00, 138.02, 18.00, '2026-08-08 08:58:33', '2026-08-08 08:58:33', '2026-08-08 08:58:33'),
(1257, 31, 31.5187302, 74.3593722, 15.00, 158.07, 18.00, '2026-08-08 08:58:37', '2026-08-08 08:58:37', '2026-08-08 08:58:37'),
(1258, 31, 31.5186010, 74.3587589, 15.00, 178.13, 18.00, '2026-08-08 08:58:41', '2026-08-08 08:58:41', '2026-08-08 08:58:41'),
(1259, 31, 31.5186898, 74.3581384, 15.00, 198.18, 18.00, '2026-08-08 08:58:48', '2026-08-08 08:58:48', '2026-08-08 08:58:48'),
(1260, 31, 31.5189861, 74.3575861, 15.00, 218.23, 18.00, '2026-08-08 08:58:49', '2026-08-08 08:58:49', '2026-08-08 08:58:49'),
(1261, 31, 31.5194538, 74.3571688, 15.00, 238.29, 18.00, '2026-08-08 08:58:54', '2026-08-08 08:58:54', '2026-08-08 08:58:54'),
(1262, 31, 31.5200362, 74.3569371, 15.00, 258.34, 18.00, '2026-08-08 08:58:57', '2026-08-08 08:58:57', '2026-08-08 08:58:57'),
(1263, 31, 31.5206627, 74.3569193, 15.00, 278.39, 18.00, '2026-08-08 08:59:01', '2026-08-08 08:59:01', '2026-08-08 08:59:01'),
(1264, 31, 31.5212574, 74.3571173, 15.00, 298.45, 18.00, '2026-08-08 08:59:05', '2026-08-08 08:59:05', '2026-08-08 08:59:05'),
(1265, 31, 31.5217481, 74.3575073, 15.00, 318.50, 18.00, '2026-08-08 08:59:09', '2026-08-08 08:59:09', '2026-08-08 08:59:09'),
(1266, 31, 31.5220754, 74.3580419, 15.00, 338.55, 18.00, '2026-08-08 08:59:14', '2026-08-08 08:59:14', '2026-08-08 08:59:14'),
(1267, 31, 31.5221995, 74.3586563, 15.00, 358.61, 18.00, '2026-08-08 08:59:17', '2026-08-08 08:59:17', '2026-08-08 08:59:17'),
(1268, 31, 31.5221054, 74.3592759, 15.00, 18.66, 18.00, '2026-08-08 08:59:28', '2026-08-08 08:59:28', '2026-08-08 08:59:28'),
(1269, 31, 31.5218045, 74.3598258, 15.00, 38.71, 18.00, '2026-08-08 08:59:28', '2026-08-08 08:59:28', '2026-08-08 08:59:28'),
(1270, 31, 31.5213333, 74.3602391, 15.00, 58.77, 18.00, '2026-08-08 08:59:30', '2026-08-08 08:59:30', '2026-08-08 08:59:30'),
(1271, 31, 31.5207490, 74.3604659, 15.00, 78.82, 18.00, '2026-08-08 08:59:34', '2026-08-08 08:59:34', '2026-08-08 08:59:34'),
(1272, 31, 31.5201223, 74.3604784, 15.00, 98.88, 18.00, '2026-08-08 08:59:37', '2026-08-08 08:59:37', '2026-08-08 08:59:37'),
(1273, 31, 31.5195293, 74.3602754, 15.00, 118.93, 18.00, '2026-08-08 08:59:41', '2026-08-08 08:59:41', '2026-08-08 08:59:41'),
(1274, 31, 31.5190419, 74.3598813, 15.00, 138.98, 18.00, '2026-08-08 08:59:45', '2026-08-08 08:59:45', '2026-08-08 08:59:45'),
(1275, 31, 31.5187192, 74.3593440, 15.00, 159.04, 18.00, '2026-08-08 08:59:49', '2026-08-08 08:59:49', '2026-08-08 08:59:49'),
(1276, 31, 31.5186002, 74.3587286, 15.00, 179.09, 18.00, '2026-08-08 08:59:53', '2026-08-08 08:59:53', '2026-08-08 08:59:53'),
(1277, 31, 31.5186995, 74.3581097, 15.00, 199.14, 18.00, '2026-08-08 08:59:57', '2026-08-08 08:59:57', '2026-08-08 08:59:57'),
(1278, 31, 31.5190050, 74.3575624, 15.00, 219.20, 18.00, '2026-08-08 09:00:01', '2026-08-08 09:00:01', '2026-08-08 09:00:01'),
(1279, 31, 31.5194797, 74.3571531, 15.00, 239.25, 18.00, '2026-08-08 09:00:05', '2026-08-08 09:00:05', '2026-08-08 09:00:05'),
(1280, 31, 31.5200659, 74.3569313, 15.00, 259.30, 18.00, '2026-08-08 09:00:09', '2026-08-08 09:00:09', '2026-08-08 09:00:09'),
(1281, 31, 31.5206926, 74.3569239, 15.00, 279.36, 18.00, '2026-08-08 09:00:13', '2026-08-08 09:00:13', '2026-08-08 09:00:13'),
(1282, 31, 31.5212839, 74.3571320, 15.00, 299.41, 18.00, '2026-08-08 09:00:17', '2026-08-08 09:00:17', '2026-08-08 09:00:17'),
(1283, 31, 31.5217680, 74.3575301, 15.00, 319.46, 18.00, '2026-08-08 09:00:21', '2026-08-08 09:00:21', '2026-08-08 09:00:21'),
(1284, 31, 31.5220862, 74.3580701, 15.00, 339.52, 18.00, '2026-08-08 09:00:25', '2026-08-08 09:00:25', '2026-08-08 09:00:25'),
(1285, 31, 31.5221999, 74.3586865, 15.00, 359.57, 18.00, '2026-08-08 09:00:29', '2026-08-08 09:00:29', '2026-08-08 09:00:29'),
(1286, 31, 31.5220954, 74.3593045, 15.00, 19.62, 18.00, '2026-08-08 09:00:33', '2026-08-08 09:00:33', '2026-08-08 09:00:33'),
(1287, 31, 31.5217854, 74.3598492, 15.00, 39.68, 18.00, '2026-08-08 09:00:37', '2026-08-08 09:00:37', '2026-08-08 09:00:37'),
(1288, 31, 31.5213073, 74.3602546, 15.00, 59.73, 18.00, '2026-08-08 09:00:41', '2026-08-08 09:00:41', '2026-08-08 09:00:41'),
(1289, 31, 31.5207192, 74.3604715, 15.00, 79.79, 18.00, '2026-08-08 09:00:45', '2026-08-08 09:00:45', '2026-08-08 09:00:45'),
(1290, 31, 31.5200924, 74.3604735, 15.00, 99.84, 18.00, '2026-08-08 09:00:49', '2026-08-08 09:00:49', '2026-08-08 09:00:49'),
(1291, 31, 31.5195029, 74.3602605, 15.00, 119.89, 18.00, '2026-08-08 09:00:53', '2026-08-08 09:00:53', '2026-08-08 09:00:53'),
(1292, 31, 31.5190222, 74.3598583, 15.00, 139.95, 18.00, '2026-08-08 09:00:57', '2026-08-08 09:00:57', '2026-08-08 09:00:57'),
(1293, 31, 31.5187086, 74.3593157, 15.00, 160.00, 18.00, '2026-08-08 09:01:01', '2026-08-08 09:01:01', '2026-08-08 09:01:01'),
(1294, 31, 31.5186000, 74.3586983, 15.00, 180.05, 18.00, '2026-08-08 09:01:05', '2026-08-08 09:01:05', '2026-08-08 09:01:05'),
(1295, 31, 31.5187097, 74.3580812, 15.00, 200.11, 18.00, '2026-08-08 09:01:09', '2026-08-08 09:01:09', '2026-08-08 09:01:09'),
(1296, 31, 31.5190243, 74.3575391, 15.00, 220.16, 18.00, '2026-08-08 09:01:13', '2026-08-08 09:01:13', '2026-08-08 09:01:13'),
(1297, 31, 31.5195058, 74.3571378, 15.00, 240.21, 18.00, '2026-08-08 09:01:17', '2026-08-08 09:01:17', '2026-08-08 09:01:17'),
(1298, 31, 31.5200957, 74.3569259, 15.00, 260.27, 18.00, '2026-08-08 09:01:21', '2026-08-08 09:01:21', '2026-08-08 09:01:21'),
(1299, 31, 31.5207225, 74.3569291, 15.00, 280.32, 18.00, '2026-08-08 09:01:25', '2026-08-08 09:01:25', '2026-08-08 09:01:25'),
(1300, 31, 31.5213101, 74.3571471, 15.00, 300.37, 18.00, '2026-08-08 09:01:29', '2026-08-08 09:01:29', '2026-08-08 09:01:29'),
(1301, 31, 31.5217875, 74.3575533, 15.00, 320.43, 18.00, '2026-08-08 09:01:33', '2026-08-08 09:01:33', '2026-08-08 09:01:33'),
(1302, 31, 31.5220966, 74.3580986, 15.00, 340.48, 18.00, '2026-08-08 09:01:37', '2026-08-08 09:01:37', '2026-08-08 09:01:37'),
(1303, 31, 31.5221999, 74.3587168, 15.00, 0.53, 18.00, '2026-08-08 09:01:41', '2026-08-08 09:01:41', '2026-08-08 09:01:41'),
(1304, 31, 31.5220850, 74.3593330, 15.00, 20.59, 18.00, '2026-08-08 09:01:45', '2026-08-08 09:01:45', '2026-08-08 09:01:45'),
(1305, 31, 31.5217658, 74.3598724, 15.00, 40.64, 18.00, '2026-08-08 09:01:49', '2026-08-08 09:01:49', '2026-08-08 09:01:49'),
(1306, 31, 31.5212810, 74.3602696, 15.00, 60.69, 18.00, '2026-08-08 09:01:53', '2026-08-08 09:01:53', '2026-08-08 09:01:53'),
(1307, 31, 31.5206894, 74.3604766, 15.00, 80.75, 18.00, '2026-08-08 09:01:57', '2026-08-08 09:01:57', '2026-08-08 09:01:57'),
(1308, 31, 31.5200627, 74.3604681, 15.00, 100.80, 18.00, '2026-08-08 09:02:01', '2026-08-08 09:02:01', '2026-08-08 09:02:01'),
(1309, 31, 31.5194768, 74.3602452, 15.00, 120.86, 18.00, '2026-08-08 09:02:05', '2026-08-08 09:02:05', '2026-08-08 09:02:05'),
(1310, 31, 31.5190029, 74.3598350, 15.00, 140.91, 18.00, '2026-08-08 09:02:09', '2026-08-08 09:02:09', '2026-08-08 09:02:09'),
(1311, 31, 31.5186985, 74.3592871, 15.00, 160.96, 18.00, '2026-08-08 09:02:13', '2026-08-08 09:02:13', '2026-08-08 09:02:13'),
(1312, 31, 31.5186003, 74.3586681, 15.00, 181.02, 18.00, '2026-08-08 09:02:17', '2026-08-08 09:02:17', '2026-08-08 09:02:17'),
(1313, 31, 31.5187203, 74.3580529, 15.00, 201.07, 18.00, '2026-08-08 09:02:21', '2026-08-08 09:02:21', '2026-08-08 09:02:21'),
(1314, 31, 31.5190441, 74.3575162, 15.00, 221.12, 18.00, '2026-08-08 09:02:25', '2026-08-08 09:02:25', '2026-08-08 09:02:25'),
(1315, 31, 31.5195322, 74.3571230, 15.00, 241.18, 18.00, '2026-08-08 09:02:29', '2026-08-08 09:02:29', '2026-08-08 09:02:29'),
(1316, 31, 31.5201256, 74.3569210, 15.00, 261.23, 18.00, '2026-08-08 09:02:33', '2026-08-08 09:02:33', '2026-08-08 09:02:33'),
(1317, 31, 31.5207522, 74.3569348, 15.00, 281.28, 18.00, '2026-08-08 09:02:37', '2026-08-08 09:02:37', '2026-08-08 09:02:37'),
(1318, 31, 31.5213361, 74.3571626, 15.00, 301.34, 18.00, '2026-08-08 09:02:41', '2026-08-08 09:02:41', '2026-08-08 09:02:41'),
(1319, 31, 31.5218066, 74.3575768, 15.00, 321.39, 18.00, '2026-08-08 09:02:45', '2026-08-08 09:02:45', '2026-08-08 09:02:45'),
(1320, 31, 31.5221064, 74.3581272, 15.00, 341.44, 18.00, '2026-08-08 09:02:49', '2026-08-08 09:02:49', '2026-08-08 09:02:49'),
(1321, 31, 31.5221994, 74.3587470, 15.00, 1.50, 18.00, '2026-08-08 09:02:53', '2026-08-08 09:02:53', '2026-08-08 09:02:53'),
(1322, 31, 31.5220742, 74.3593612, 15.00, 21.55, 18.00, '2026-08-08 09:02:57', '2026-08-08 09:02:57', '2026-08-08 09:02:57'),
(1323, 31, 31.5217459, 74.3598952, 15.00, 41.60, 18.00, '2026-08-08 09:03:01', '2026-08-08 09:03:01', '2026-08-08 09:03:01'),
(1324, 31, 31.5212545, 74.3602842, 15.00, 61.66, 18.00, '2026-08-08 09:03:05', '2026-08-08 09:03:05', '2026-08-08 09:03:05'),
(1325, 31, 31.5206595, 74.3604812, 15.00, 81.71, 18.00, '2026-08-08 09:03:09', '2026-08-08 09:03:09', '2026-08-08 09:03:09'),
(1326, 31, 31.5200330, 74.3604622, 15.00, 101.77, 18.00, '2026-08-08 09:03:13', '2026-08-08 09:03:13', '2026-08-08 09:03:13'),
(1327, 31, 31.5194510, 74.3602295, 15.00, 121.82, 18.00, '2026-08-08 09:03:17', '2026-08-08 09:03:17', '2026-08-08 09:03:17'),
(1328, 31, 31.5189841, 74.3598113, 15.00, 141.87, 18.00, '2026-08-08 09:03:21', '2026-08-08 09:03:21', '2026-08-08 09:03:21'),
(1329, 31, 31.5186888, 74.3592584, 15.00, 161.93, 18.00, '2026-08-08 09:03:25', '2026-08-08 09:03:25', '2026-08-08 09:03:25'),
(1330, 31, 31.5186011, 74.3586378, 15.00, 181.98, 18.00, '2026-08-08 09:03:29', '2026-08-08 09:03:29', '2026-08-08 09:03:29'),
(1331, 31, 31.5187315, 74.3580247, 15.00, 202.03, 18.00, '2026-08-08 09:03:33', '2026-08-08 09:03:33', '2026-08-08 09:03:33'),
(1332, 31, 31.5190642, 74.3574935, 15.00, 222.09, 18.00, '2026-08-08 09:03:37', '2026-08-08 09:03:37', '2026-08-08 09:03:37'),
(1333, 31, 31.5195588, 74.3571086, 15.00, 242.14, 18.00, '2026-08-08 09:03:41', '2026-08-08 09:03:41', '2026-08-08 09:03:41'),
(1334, 31, 31.5201555, 74.3569167, 15.00, 262.19, 18.00, '2026-08-08 09:03:45', '2026-08-08 09:03:45', '2026-08-08 09:03:45'),
(1335, 31, 31.5207818, 74.3569410, 15.00, 282.25, 18.00, '2026-08-08 09:03:49', '2026-08-08 09:03:49', '2026-08-08 09:03:49'),
(1336, 31, 31.5213618, 74.3571785, 15.00, 302.30, 18.00, '2026-08-08 09:03:53', '2026-08-08 09:03:53', '2026-08-08 09:03:53'),
(1337, 31, 31.5218252, 74.3576006, 15.00, 322.35, 18.00, '2026-08-08 09:03:57', '2026-08-08 09:03:57', '2026-08-08 09:03:57'),
(1338, 31, 31.5221158, 74.3581560, 15.00, 342.41, 18.00, '2026-08-08 09:04:01', '2026-08-08 09:04:01', '2026-08-08 09:04:01'),
(1339, 31, 31.5221983, 74.3587773, 15.00, 2.46, 18.00, '2026-08-08 09:04:05', '2026-08-08 09:04:05', '2026-08-08 09:04:05'),
(1340, 31, 31.5220628, 74.3593893, 15.00, 22.51, 18.00, '2026-08-08 09:04:09', '2026-08-08 09:04:09', '2026-08-08 09:04:09'),
(1341, 31, 31.5217257, 74.3599176, 15.00, 42.57, 18.00, '2026-08-08 09:04:13', '2026-08-08 09:04:13', '2026-08-08 09:04:13'),
(1342, 31, 31.5212278, 74.3602984, 15.00, 62.62, 18.00, '2026-08-08 09:04:17', '2026-08-08 09:04:17', '2026-08-08 09:04:17'),
(1343, 31, 31.5206295, 74.3604853, 15.00, 82.68, 18.00, '2026-08-08 09:04:21', '2026-08-08 09:04:21', '2026-08-08 09:04:21'),
(1344, 31, 31.5200034, 74.3604558, 15.00, 102.73, 18.00, '2026-08-08 09:04:25', '2026-08-08 09:04:25', '2026-08-08 09:04:25'),
(1345, 31, 31.5194254, 74.3602133, 15.00, 122.78, 18.00, '2026-08-08 09:04:29', '2026-08-08 09:04:29', '2026-08-08 09:04:29'),
(1346, 31, 31.5189656, 74.3597874, 15.00, 142.84, 18.00, '2026-08-08 09:04:33', '2026-08-08 09:04:33', '2026-08-08 09:04:33'),
(1347, 31, 31.5186797, 74.3592296, 15.00, 162.89, 18.00, '2026-08-08 09:04:37', '2026-08-08 09:04:37', '2026-08-08 09:04:37'),
(1348, 31, 31.5186024, 74.3586076, 15.00, 182.94, 18.00, '2026-08-08 09:04:41', '2026-08-08 09:04:41', '2026-08-08 09:04:41'),
(1349, 31, 31.5187430, 74.3579968, 15.00, 203.00, 18.00, '2026-08-08 09:04:46', '2026-08-08 09:04:46', '2026-08-08 09:04:46'),
(1350, 31, 31.5190846, 74.3574713, 15.00, 223.05, 18.00, '2026-08-08 09:04:49', '2026-08-08 09:04:49', '2026-08-08 09:04:49'),
(1351, 31, 31.5195857, 74.3570947, 15.00, 243.10, 18.00, '2026-08-08 09:04:53', '2026-08-08 09:04:53', '2026-08-08 09:04:53'),
(1352, 31, 31.5201855, 74.3569128, 15.00, 263.16, 18.00, '2026-08-08 09:04:58', '2026-08-08 09:04:58', '2026-08-08 09:04:58'),
(1353, 31, 31.5208114, 74.3569476, 15.00, 283.21, 18.00, '2026-08-08 09:05:01', '2026-08-08 09:05:01', '2026-08-08 09:05:01'),
(1354, 31, 31.5213873, 74.3571949, 15.00, 303.26, 18.00, '2026-08-08 09:05:05', '2026-08-08 09:05:05', '2026-08-08 09:05:05'),
(1355, 31, 31.5218435, 74.3576247, 15.00, 323.32, 18.00, '2026-08-08 09:05:09', '2026-08-08 09:05:09', '2026-08-08 09:05:09'),
(1356, 31, 31.5221247, 74.3581849, 15.00, 343.37, 18.00, '2026-08-08 09:05:14', '2026-08-08 09:05:14', '2026-08-08 09:05:14'),
(1357, 31, 31.5221968, 74.3588075, 15.00, 3.42, 18.00, '2026-08-08 09:05:17', '2026-08-08 09:05:17', '2026-08-08 09:05:17'),
(1358, 31, 31.5220510, 74.3594171, 15.00, 23.48, 18.00, '2026-08-08 09:05:22', '2026-08-08 09:05:22', '2026-08-08 09:05:22'),
(1359, 31, 31.5217050, 74.3599398, 15.00, 43.53, 18.00, '2026-08-08 09:05:25', '2026-08-08 09:05:25', '2026-08-08 09:05:25'),
(1360, 31, 31.5212008, 74.3603121, 15.00, 63.59, 18.00, '2026-08-08 09:05:29', '2026-08-08 09:05:29', '2026-08-08 09:05:29'),
(1361, 31, 31.5205994, 74.3604889, 15.00, 83.64, 18.00, '2026-08-08 09:05:33', '2026-08-08 09:05:33', '2026-08-08 09:05:33'),
(1362, 31, 31.5199739, 74.3604488, 15.00, 103.69, 18.00, '2026-08-08 09:05:37', '2026-08-08 09:05:37', '2026-08-08 09:05:37'),
(1363, 31, 31.5194001, 74.3601967, 15.00, 123.75, 18.00, '2026-08-08 09:05:41', '2026-08-08 09:05:41', '2026-08-08 09:05:41'),
(1364, 31, 31.5189475, 74.3597631, 15.00, 143.80, 18.00, '2026-08-08 09:05:45', '2026-08-08 09:05:45', '2026-08-08 09:05:45'),
(1365, 31, 31.5186710, 74.3592006, 15.00, 163.85, 18.00, '2026-08-08 09:05:49', '2026-08-08 09:05:49', '2026-08-08 09:05:49'),
(1366, 31, 31.5186042, 74.3585774, 15.00, 183.91, 18.00, '2026-08-08 09:05:53', '2026-08-08 09:05:53', '2026-08-08 09:05:53'),
(1367, 31, 31.5187551, 74.3579690, 15.00, 203.96, 18.00, '2026-08-08 09:05:57', '2026-08-08 09:05:57', '2026-08-08 09:05:57'),
(1368, 31, 31.5191055, 74.3574493, 15.00, 224.01, 18.00, '2026-08-08 09:06:01', '2026-08-08 09:06:01', '2026-08-08 09:06:01'),
(1369, 31, 31.5196128, 74.3570813, 15.00, 244.07, 18.00, '2026-08-08 09:06:05', '2026-08-08 09:06:05', '2026-08-08 09:06:05'),
(1370, 31, 31.5202156, 74.3569095, 15.00, 264.12, 18.00, '2026-08-08 09:06:09', '2026-08-08 09:06:09', '2026-08-08 09:06:09'),
(1371, 31, 31.5208408, 74.3569548, 15.00, 284.17, 18.00, '2026-08-08 09:06:13', '2026-08-08 09:06:13', '2026-08-08 09:06:13'),
(1372, 31, 31.5214125, 74.3572117, 15.00, 304.23, 18.00, '2026-08-08 09:06:17', '2026-08-08 09:06:17', '2026-08-08 09:06:17'),
(1373, 31, 31.5218614, 74.3576491, 15.00, 324.28, 18.00, '2026-08-08 09:06:21', '2026-08-08 09:06:21', '2026-08-08 09:06:21'),
(1374, 31, 31.5221331, 74.3582140, 15.00, 344.33, 18.00, '2026-08-08 09:06:25', '2026-08-08 09:06:25', '2026-08-08 09:06:25'),
(1375, 31, 31.5221947, 74.3588377, 15.00, 4.39, 18.00, '2026-08-08 09:06:29', '2026-08-08 09:06:29', '2026-08-08 09:06:29'),
(1376, 31, 31.5220387, 74.3594448, 15.00, 24.44, 18.00, '2026-08-08 09:06:33', '2026-08-08 09:06:33', '2026-08-08 09:06:33'),
(1377, 31, 31.5216840, 74.3599615, 15.00, 44.50, 18.00, '2026-08-08 09:06:37', '2026-08-08 09:06:37', '2026-08-08 09:06:37'),
(1378, 31, 31.5211735, 74.3603253, 15.00, 64.55, 18.00, '2026-08-08 09:06:41', '2026-08-08 09:06:41', '2026-08-08 09:06:41'),
(1379, 31, 31.5205693, 74.3604920, 15.00, 84.60, 18.00, '2026-08-08 09:06:45', '2026-08-08 09:06:45', '2026-08-08 09:06:45'),
(1380, 31, 31.5199446, 74.3604414, 15.00, 104.66, 18.00, '2026-08-08 09:06:49', '2026-08-08 09:06:49', '2026-08-08 09:06:49'),
(1381, 31, 31.5193751, 74.3601797, 15.00, 124.71, 18.00, '2026-08-08 09:06:53', '2026-08-08 09:06:53', '2026-08-08 09:06:53'),
(1382, 31, 31.5189298, 74.3597385, 15.00, 144.76, 18.00, '2026-08-08 09:06:57', '2026-08-08 09:06:57', '2026-08-08 09:06:57'),
(1383, 31, 31.5186628, 74.3591715, 15.00, 164.82, 18.00, '2026-08-08 09:07:01', '2026-08-08 09:07:01', '2026-08-08 09:07:01'),
(1384, 31, 31.5186065, 74.3585472, 15.00, 184.87, 18.00, '2026-08-08 09:07:05', '2026-08-08 09:07:05', '2026-08-08 09:07:05'),
(1385, 31, 31.5187676, 74.3579415, 15.00, 204.92, 18.00, '2026-08-08 09:07:09', '2026-08-08 09:07:09', '2026-08-08 09:07:09'),
(1386, 31, 31.5191267, 74.3574277, 15.00, 224.98, 18.00, '2026-08-08 09:07:15', '2026-08-08 09:07:15', '2026-08-08 09:07:15'),
(1387, 31, 31.5196401, 74.3570682, 15.00, 245.03, 18.00, '2026-08-08 09:07:17', '2026-08-08 09:07:17', '2026-08-08 09:07:17'),
(1388, 31, 31.5202457, 74.3569066, 15.00, 265.08, 18.00, '2026-08-08 09:07:21', '2026-08-08 09:07:21', '2026-08-08 09:07:21'),
(1389, 31, 31.5208700, 74.3569625, 15.00, 285.14, 18.00, '2026-08-08 09:07:25', '2026-08-08 09:07:25', '2026-08-08 09:07:25'),
(1390, 31, 31.5214373, 74.3572290, 15.00, 305.19, 18.00, '2026-08-08 09:07:29', '2026-08-08 09:07:29', '2026-08-08 09:07:29'),
(1391, 31, 31.5218789, 74.3576739, 15.00, 325.24, 18.00, '2026-08-08 10:27:34', '2026-08-08 10:27:34', '2026-08-08 10:27:34'),
(1392, 31, 31.5221411, 74.3582432, 15.00, 345.30, 18.00, '2026-08-08 10:27:34', '2026-08-08 10:27:34', '2026-08-08 10:27:34'),
(1393, 31, 31.5221922, 74.3588679, 15.00, 5.35, 18.00, '2026-08-08 10:27:36', '2026-08-08 10:27:36', '2026-08-08 10:27:36'),
(1394, 31, 31.5220259, 74.3594722, 15.00, 25.40, 18.00, '2026-08-08 10:27:37', '2026-08-08 10:27:37', '2026-08-08 10:27:37'),
(1395, 31, 31.5216626, 74.3599829, 15.00, 45.46, 18.00, '2026-08-08 10:27:37', '2026-08-08 10:27:37', '2026-08-08 10:27:37'),
(1396, 31, 31.5211461, 74.3603381, 15.00, 65.51, 18.00, '2026-08-08 10:27:41', '2026-08-08 10:27:41', '2026-08-08 10:27:41'),
(1397, 31, 31.5205392, 74.3604946, 15.00, 85.57, 18.00, '2026-08-08 10:27:45', '2026-08-08 10:27:45', '2026-08-08 10:27:45'),
(1398, 31, 31.5199154, 74.3604335, 15.00, 105.62, 18.00, '2026-08-08 10:27:50', '2026-08-08 10:27:50', '2026-08-08 10:27:50'),
(1399, 31, 31.5193503, 74.3601623, 15.00, 125.67, 18.00, '2026-08-08 10:27:53', '2026-08-08 10:27:53', '2026-08-08 10:27:53'),
(1400, 31, 31.5189126, 74.3597137, 15.00, 145.73, 18.00, '2026-08-08 10:27:57', '2026-08-08 10:27:57', '2026-08-08 10:27:57'),
(1401, 31, 31.5186552, 74.3591422, 15.00, 165.78, 18.00, '2026-08-08 10:28:01', '2026-08-08 10:28:01', '2026-08-08 10:28:01'),
(1402, 31, 31.5186093, 74.3585171, 15.00, 185.83, 18.00, '2026-08-08 10:28:05', '2026-08-08 10:28:05', '2026-08-08 10:28:05'),
(1403, 31, 31.5187806, 74.3579141, 15.00, 205.89, 18.00, '2026-08-08 10:28:09', '2026-08-08 10:28:09', '2026-08-08 10:28:09'),
(1404, 31, 31.5191483, 74.3574065, 15.00, 225.94, 18.00, '2026-08-08 10:28:13', '2026-08-08 10:28:13', '2026-08-08 10:28:13'),
(1405, 31, 31.5196677, 74.3570557, 15.00, 245.99, 18.00, '2026-08-08 10:28:17', '2026-08-08 10:28:17', '2026-08-08 10:28:17'),
(1406, 31, 31.5202759, 74.3569043, 15.00, 266.05, 18.00, '2026-08-08 10:28:21', '2026-08-08 10:28:21', '2026-08-08 10:28:21'),
(1407, 31, 31.5208992, 74.3569706, 15.00, 286.10, 18.00, '2026-08-08 10:28:25', '2026-08-08 10:28:25', '2026-08-08 10:28:25'),
(1408, 31, 31.5214619, 74.3572466, 15.00, 306.15, 18.00, '2026-08-08 10:28:29', '2026-08-08 10:28:29', '2026-08-08 10:28:29'),
(1409, 31, 31.5218959, 74.3576989, 15.00, 326.21, 18.00, '2026-08-08 10:28:33', '2026-08-08 10:28:33', '2026-08-08 10:28:33'),
(1410, 31, 31.5221485, 74.3582725, 15.00, 346.26, 18.00, '2026-08-08 10:28:37', '2026-08-08 10:28:37', '2026-08-08 10:28:37'),
(1411, 31, 31.5221891, 74.3588980, 15.00, 6.31, 18.00, '2026-08-08 10:28:41', '2026-08-08 10:28:41', '2026-08-08 10:28:41'),
(1412, 31, 31.5220127, 74.3594995, 15.00, 26.37, 18.00, '2026-08-08 10:28:45', '2026-08-08 10:28:45', '2026-08-08 10:28:45'),
(1413, 31, 31.5216408, 74.3600040, 15.00, 46.42, 18.00, '2026-08-08 10:28:49', '2026-08-08 10:28:49', '2026-08-08 10:28:49'),
(1414, 31, 31.5211185, 74.3603504, 15.00, 66.48, 18.00, '2026-08-08 10:28:53', '2026-08-08 10:28:53', '2026-08-08 10:28:53'),
(1415, 31, 31.5205090, 74.3604967, 15.00, 86.53, 18.00, '2026-08-08 10:28:57', '2026-08-08 10:28:57', '2026-08-08 10:28:57'),
(1416, 31, 31.5198863, 74.3604251, 15.00, 106.58, 18.00, '2026-08-08 10:29:01', '2026-08-08 10:29:01', '2026-08-08 10:29:01'),
(1417, 31, 31.5193259, 74.3601444, 15.00, 126.64, 18.00, '2026-08-08 10:29:05', '2026-08-08 10:29:05', '2026-08-08 10:29:05'),
(1418, 31, 31.5188957, 74.3596885, 15.00, 146.69, 18.00, '2026-08-08 10:29:09', '2026-08-08 10:29:09', '2026-08-08 10:29:09'),
(1419, 31, 31.5186480, 74.3591128, 15.00, 166.74, 18.00, '2026-08-08 10:29:13', '2026-08-08 10:29:13', '2026-08-08 10:29:13'),
(1420, 31, 31.5186126, 74.3584870, 15.00, 186.80, 18.00, '2026-08-08 10:29:17', '2026-08-08 10:29:17', '2026-08-08 10:29:17'),
(1421, 31, 31.5187941, 74.3578870, 15.00, 206.85, 18.00, '2026-08-08 10:29:21', '2026-08-08 10:29:21', '2026-08-08 10:29:21'),
(1422, 31, 31.5191702, 74.3573856, 15.00, 226.90, 18.00, '2026-08-08 10:29:25', '2026-08-08 10:29:25', '2026-08-08 10:29:25'),
(1423, 31, 31.5196954, 74.3570436, 15.00, 246.96, 18.00, '2026-08-08 10:29:29', '2026-08-08 10:29:29', '2026-08-08 10:29:29'),
(1424, 31, 31.5203061, 74.3569024, 15.00, 267.01, 18.00, '2026-08-08 10:29:33', '2026-08-08 10:29:33', '2026-08-08 10:29:33'),
(1425, 31, 31.5209282, 74.3569792, 15.00, 287.06, 18.00, '2026-08-08 10:29:37', '2026-08-08 10:29:37', '2026-08-08 10:29:37'),
(1426, 31, 31.5214862, 74.3572647, 15.00, 307.12, 18.00, '2026-08-08 10:29:41', '2026-08-08 10:29:41', '2026-08-08 10:29:41'),
(1427, 31, 31.5219125, 74.3577242, 15.00, 327.17, 18.00, '2026-08-08 10:29:45', '2026-08-08 10:29:45', '2026-08-08 10:29:45'),
(1428, 31, 31.5221554, 74.3583020, 15.00, 347.22, 18.00, '2026-08-08 10:29:49', '2026-08-08 10:29:49', '2026-08-08 10:29:49'),
(1429, 31, 31.5221855, 74.3589280, 15.00, 7.28, 18.00, '2026-08-08 10:29:53', '2026-08-08 10:29:53', '2026-08-08 10:29:53'),
(1430, 31, 31.5219991, 74.3595265, 15.00, 27.33, 18.00, '2026-08-08 10:29:57', '2026-08-08 10:29:57', '2026-08-08 10:29:57'),
(1431, 31, 31.5216187, 74.3600247, 15.00, 47.39, 18.00, '2026-08-08 10:30:01', '2026-08-08 10:30:01', '2026-08-08 10:30:01'),
(1432, 31, 31.5210906, 74.3603622, 15.00, 67.44, 18.00, '2026-08-08 10:30:05', '2026-08-08 10:30:05', '2026-08-08 10:30:05'),
(1433, 31, 31.5204788, 74.3604983, 15.00, 87.49, 18.00, '2026-08-08 10:30:09', '2026-08-08 10:30:09', '2026-08-08 10:30:09'),
(1434, 31, 31.5198574, 74.3604163, 15.00, 107.55, 18.00, '2026-08-08 10:30:13', '2026-08-08 10:30:13', '2026-08-08 10:30:13'),
(1435, 31, 31.5193018, 74.3601261, 15.00, 127.60, 18.00, '2026-08-08 10:30:17', '2026-08-08 10:30:17', '2026-08-08 10:30:17'),
(1436, 31, 31.5188793, 74.3596631, 15.00, 147.65, 18.00, '2026-08-08 10:30:21', '2026-08-08 10:30:21', '2026-08-08 10:30:21'),
(1437, 33, 31.5222000, 74.3587000, 15.00, 0.00, 18.00, '2026-08-09 12:21:40', '2026-08-09 12:21:40', '2026-08-09 12:21:40'),
(1438, 33, 31.5220909, 74.3593172, 15.00, 20.05, 18.00, '2026-08-09 12:21:44', '2026-08-09 12:21:44', '2026-08-09 12:21:44'),
(1439, 33, 31.5217767, 74.3598596, 15.00, 40.11, 18.00, '2026-08-09 12:21:48', '2026-08-09 12:21:48', '2026-08-09 12:21:48'),
(1440, 33, 31.5212956, 74.3602614, 15.00, 60.16, 18.00, '2026-08-09 12:21:52', '2026-08-09 12:21:52', '2026-08-09 12:21:52'),
(1441, 33, 31.5207059, 74.3604738, 15.00, 80.21, 18.00, '2026-08-09 12:21:56', '2026-08-09 12:21:56', '2026-08-09 12:21:56'),
(1442, 33, 31.5200792, 74.3604712, 15.00, 100.27, 18.00, '2026-08-09 12:22:00', '2026-08-09 12:22:00', '2026-08-09 12:22:00'),
(1443, 33, 31.5194913, 74.3602538, 15.00, 120.32, 18.00, '2026-08-09 12:22:04', '2026-08-09 12:22:04', '2026-08-09 12:22:04'),
(1444, 33, 31.5222000, 74.3587000, 15.00, 0.00, 18.00, '2026-08-09 12:22:09', '2026-08-09 12:22:09', '2026-08-09 12:22:09'),
(1445, 33, 31.5220909, 74.3593172, 15.00, 20.05, 18.00, '2026-08-09 12:22:13', '2026-08-09 12:22:13', '2026-08-09 12:22:13'),
(1446, 33, 31.5217767, 74.3598596, 15.00, 40.11, 18.00, '2026-08-09 12:22:18', '2026-08-09 12:22:18', '2026-08-09 12:22:18'),
(1447, 33, 31.5212956, 74.3602614, 15.00, 60.16, 18.00, '2026-08-09 12:22:21', '2026-08-09 12:22:21', '2026-08-09 12:22:21'),
(1448, 33, 31.5207059, 74.3604738, 15.00, 80.21, 18.00, '2026-08-09 12:22:25', '2026-08-09 12:22:25', '2026-08-09 12:22:25'),
(1449, 33, 31.5200792, 74.3604712, 15.00, 100.27, 18.00, '2026-08-09 12:22:30', '2026-08-09 12:22:30', '2026-08-09 12:22:30'),
(1450, 33, 31.5222000, 74.3587000, 15.00, 0.00, 18.00, '2026-08-09 12:22:35', '2026-08-09 12:22:35', '2026-08-09 12:22:35'),
(1451, 33, 31.5220909, 74.3593172, 15.00, 20.05, 18.00, '2026-08-09 12:22:39', '2026-08-09 12:22:39', '2026-08-09 12:22:39'),
(1452, 33, 31.5217767, 74.3598596, 15.00, 40.11, 18.00, '2026-08-09 12:22:43', '2026-08-09 12:22:43', '2026-08-09 12:22:43'),
(1453, 33, 31.5212956, 74.3602614, 15.00, 60.16, 18.00, '2026-08-09 12:22:48', '2026-08-09 12:22:48', '2026-08-09 12:22:48'),
(1454, 33, 31.5207059, 74.3604738, 15.00, 80.21, 18.00, '2026-08-09 12:22:51', '2026-08-09 12:22:51', '2026-08-09 12:22:51'),
(1455, 33, 31.5200792, 74.3604712, 15.00, 100.27, 18.00, '2026-08-09 12:22:56', '2026-08-09 12:22:56', '2026-08-09 12:22:56'),
(1456, 35, 31.4416375, 74.1942761, 93.00, 0.00, 0.00, '2026-08-09 23:02:46', '2026-08-09 23:02:46', '2026-08-09 23:02:46'),
(1457, 35, 31.4416375, 74.1942761, 93.00, 0.00, 0.00, '2026-08-09 23:02:46', '2026-08-09 23:02:46', '2026-08-09 23:02:46'),
(1458, 35, 31.4417783, 74.1944241, 85.00, 0.00, 0.00, '2026-08-09 23:03:01', '2026-08-09 23:03:01', '2026-08-09 23:03:01'),
(1459, 35, 31.4417783, 74.1944241, 85.00, 0.00, 0.00, '2026-08-09 23:03:32', '2026-08-09 23:03:32', '2026-08-09 23:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '92', NULL, '$2y$12$WDzb9Gff2SKNr30ewADo8OYKZJ44DYWeZq4qzh7gAiF0u44Tlhjsa', NULL, '2026-08-07 15:02:31', '2026-08-07 15:02:31'),
(2, 'Student User', 'student@example.com', '92', NULL, '$2y$12$BSp5A8MCjTIlEp70J0LSDeTufL/FGAqnhHmERg963L508mSLjdxV6', NULL, '2026-08-07 15:02:31', '2026-08-07 15:02:31'),
(3, 'Driver User', 'driver@example.com', '92', NULL, '$2y$12$wAbsg3vcdTcuW8BaU.U.vODdJvd2D1pc55DNiZyo3n2lG8bzgJ6zu', NULL, '2026-08-07 15:02:32', '2026-08-07 15:02:32'),
(4, 'Parent User', 'parent@example.com', '92', NULL, '$2y$12$JHjBAPbeRJ6JDpqYjcazNe2hxB//gGI3gLCJDxNORJA0b1QOoM6pq', NULL, '2026-08-07 15:02:32', '2026-08-07 15:02:32'),
(5, 'School Administrator', 'admin@school.com', '+92-300-1234567', NULL, '$2y$12$/K70EDNJDSFxSzFiQffVlePp6FFm2ZdjHu/9G0NIrxnUIFaJehijS', NULL, '2026-08-07 15:02:33', '2026-08-07 15:02:33'),
(6, 'Ahmed Khan', 'ahmed.khan@school.com', '+92-300-1111111', NULL, '$2y$12$n24x53vewMWes6PsfLuvY.QyLpEV/pQabDOkVEW1rIEPmOnsU6oS.', NULL, '2026-08-07 15:02:34', '2026-08-07 15:02:34'),
(7, 'Muhammad Ali', 'muhammad.ali@school.com', '+92-300-2222222', NULL, '$2y$12$7L4wxBo6NhL9AP8ZIt8g2ut5W/P6eL3hKd476fwXLX.GcHZH6MDti', NULL, '2026-08-07 15:02:34', '2026-08-07 15:02:34'),
(8, 'Hassan Sheikh', 'hassan.sheikh@school.com', '+92-300-3333333', NULL, '$2y$12$42PsoUTeDMNsKzRTrUqU9OYQrgAhWGQI1DbWdk8x40/kFsE5C9yti', NULL, '2026-08-07 15:02:35', '2026-08-07 15:02:35'),
(9, 'Usman Ahmed', 'usman.ahmed@school.com', '+92-300-4444444', NULL, '$2y$12$cHwLnejx.ZxJ0GYt15G/Ku9QerkjtuyZb.oDCe/3bssr9LUf2Ebgu', NULL, '2026-08-07 15:02:35', '2026-08-07 15:02:35'),
(10, 'Saeed Khan', 'saeed.khan@school.com', '+92-300-5555555', NULL, '$2y$12$aauZQhq3EllzLJFDBTlOe.Zkv3Ed9o9vN4ShoVDtAfq1xbWsE/qhS', NULL, '2026-08-07 15:02:36', '2026-08-07 15:02:36'),
(11, 'Fatima Khan', 'fatima.khan@email.com', '+92-300-6666666', NULL, '$2y$12$RfJWlQrZopXkj5fExjv3ZubkZ0GQAWaq4ckuxjdHstRJr75NBt9cu', NULL, '2026-08-07 15:02:36', '2026-08-07 15:02:36'),
(12, 'Ayesha Ahmed', 'ayesha.ahmed@email.com', '+92-300-7777777', NULL, '$2y$12$jeEDT301ZeKlln6YKCJstuGc9XR82lNCzkEZZqLkex/0pYPxZ/ru.', NULL, '2026-08-07 15:02:37', '2026-08-07 15:02:37'),
(13, 'Zainab Ali', 'zainab.ali@email.com', '+92-300-8888888', NULL, '$2y$12$0PgzqbCf9HvA3pUL.V5c3Ofa.8e980w.XlvsaG5DRXCoLycVZzz.2', NULL, '2026-08-07 15:02:37', '2026-08-07 15:02:37'),
(14, 'Sara Sheikh', 'sara.sheikh@email.com', '+92-300-9999999', NULL, '$2y$12$9mPxcwB1nQ.ahHaSu/GU7OGm9ZzOcybUYjPLVyDRHlGemWrlJFeiu', NULL, '2026-08-07 15:02:38', '2026-08-07 15:02:38'),
(15, 'Maryam Khan', 'maryam.khan@email.com', '+92-300-1010101', NULL, '$2y$12$Ryj3dtytYW4yu8cYhfWAcO5rpGJ5A61X0RLazO3v9zqYDTQEfQ2o.', NULL, '2026-08-07 15:02:38', '2026-08-07 15:02:38'),
(16, 'Amina Ahmed', 'amina.ahmed@email.com', '+92-300-2020202', NULL, '$2y$12$rWP06cjfTzM2ZYEbTGFzFOa.ItzSkUi0x.6iCkStQGI.4kb3Ds3gq', NULL, '2026-08-07 15:02:39', '2026-08-07 15:02:39'),
(17, 'Khadija Ali', 'khadija.ali@email.com', '+92-300-3030303', NULL, '$2y$12$9TRX36Utx7098Fae.ym9/ebmo3cOgKqg/gE8/dFU1rZz7XheZ.Hbm', NULL, '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(18, 'Hafsa Sheikh', 'hafsa.sheikh@email.com', '+92-300-4040404', NULL, '$2y$12$QhaA6ThRKItZfs4UlODX2eJotl28TI66Wy0aGa/.lMc39qTnBqP0q', NULL, '2026-08-07 15:02:40', '2026-08-07 15:02:40'),
(19, 'API Driver', 'driver.api@test.com', '923001112233', NULL, '$2y$12$u/wx9Mn2Bn9zlU3OQyZ/MOLRSYpA/07qemlK.G8l.UTk8TrqVqp6q', NULL, '2026-08-07 15:26:12', '2026-08-07 15:26:12'),
(20, 'API Guardian', 'guardian.api@test.com', '923004445566', NULL, '$2y$12$42.EXpRd4rO51sqmN1ljiOgN10.Uoh7p5y3v.Q/ZLdIauRV/sVtZ2', NULL, '2026-08-07 15:26:13', '2026-08-07 15:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number_plate` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `number_plate`, `model`, `type`, `is_available`, `status`, `notes`, `driver_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'KHI-2024-001', 'Toyota Hiace', 'van', 0, 'active', NULL, 6, 1, '2026-08-07 15:02:40', '2026-08-09 23:03:31'),
(2, 'KHI-2024-002', 'Hino Bus', 'bus', 1, 'active', NULL, 7, 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(3, 'KHI-2024-003', 'Suzuki Carry', 'van', 0, 'active', NULL, 8, 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(4, 'KHI-2024-004', 'Toyota Coaster', 'bus', 0, 'active', NULL, 9, 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24'),
(5, 'KHI-2024-005', 'Honda City', 'car', 0, 'active', NULL, 10, 1, '2026-08-07 15:02:40', '2026-08-07 16:20:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_tokens_token_unique` (`token`),
  ADD KEY `device_tokens_user_id_platform_index` (`user_id`,`platform`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guardians_cnic_unique` (`cnic`),
  ADD KEY `guardians_user_id_foreign` (`user_id`),
  ADD KEY `guardians_created_at_index` (`created_at`),
  ADD KEY `guardians_cnic_index` (`cnic`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_role_id_index` (`model_id`,`role_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routes_school_id_foreign` (`school_id`),
  ADD KEY `routes_created_at_index` (`created_at`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_email_unique` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_roll_number_unique` (`roll_number`),
  ADD KEY `students_lat_lng_index` (`latitude`,`longitude`),
  ADD KEY `students_school_id_created_at_index` (`school_id`,`created_at`),
  ADD KEY `students_parent_id_created_at_index` (`parent_id`,`created_at`),
  ADD KEY `students_class_created_at_index` (`class`,`created_at`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trips_driver_id_foreign` (`driver_id`),
  ADD KEY `trips_school_id_foreign` (`school_id`),
  ADD KEY `trips_status_created_at_index` (`status`,`created_at`),
  ADD KEY `trips_student_id_status_index` (`student_id`,`status`),
  ADD KEY `trips_vehicle_id_status_index` (`vehicle_id`,`status`),
  ADD KEY `trips_route_id_status_index` (`route_id`,`status`),
  ADD KEY `trips_started_at_ended_at_index` (`started_at`,`ended_at`),
  ADD KEY `trips_created_at_status_index` (`created_at`,`status`);

--
-- Indexes for table `trip_locations`
--
ALTER TABLE `trip_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_locations_trip_id_created_at_index` (`trip_id`,`created_at`),
  ADD KEY `trip_locations_latitude_longitude_index` (`latitude`,`longitude`),
  ADD KEY `trip_locations_trip_id_recorded_at_index` (`trip_id`,`recorded_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_at_index` (`created_at`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_school_id_foreign` (`school_id`),
  ADD KEY `vehicles_is_available_status_index` (`is_available`,`status`),
  ADD KEY `vehicles_driver_id_is_available_index` (`driver_id`,`is_available`),
  ADD KEY `vehicles_created_at_index` (`created_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `trip_locations`
--
ALTER TABLE `trip_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1460;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD CONSTRAINT `device_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guardians`
--
ALTER TABLE `guardians`
  ADD CONSTRAINT `guardians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `guardians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trips_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trips_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trips_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trips_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trip_locations`
--
ALTER TABLE `trip_locations`
  ADD CONSTRAINT `trip_locations_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicles_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
