-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 11:26 AM
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
-- Database: `simple_faq_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `likes_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `content`, `likes_count`) VALUES
(1, 'How to install composer?', '<h3>1. Using the Installer:</h3>\n<ul>\n    <li><strong>Download the installer:</strong> Go to the Composer download page and download the <code>composer-setup.exe</code> file.</li>\n    <li><strong>Run the installer:</strong> Execute the downloaded installer file.</li>\n    <li><strong>Configure PHP:</strong> The installer will ask for the location of your PHP executable. Ensure you provide the correct path.</li>\n    <li><strong>Follow the prompts:</strong> The installer will guide you through the rest of the installation process.</li>\n    <li><strong>Verify installation:</strong> Open your command prompt or terminal and type <code>composer</code>. If the installation was successful, you\'ll see Composer\'s help information displayed.</li>\n</ul>\n\n<h3>2. Manual Installation (for advanced users):</h3>\n<ul>\n    <li><strong>Download the installer:</strong> Download the installer script from the Composer download page.</li>\n    <li><strong>Verify the installer:</strong> Use the SHA-384 checksum provided on the download page to verify the installer\'s integrity.</li>\n    <li><strong>Run the installer:</strong> Execute the downloaded installer script.</li>\n    <li><strong>Create a <code>composer.bat</code> file:</strong> Create a new file named <code>composer.bat</code> in a directory that\'s on your system\'s PATH environment variable.</li>\n    <li><strong>Add the directory to your PATH:</strong> Add the directory containing the <code>composer.bat</code> file to your PATH environment variable.</li>\n    <li><strong>Test usage:</strong> Open a new terminal and type <code>composer</code> to verify the installation.</li>\n</ul>\n\n<p><strong>Refer:</strong> <a href=\"https://getcomposer.org/download/\" target=\"_blank\">https://getcomposer.org/download/</a></p>', 52),
(2, 'How to Run this project?', '<ol> <li> <strong>Install Composer (if not already installed):</strong><br> Download and install Composer from the official site:<br> <a href=\"https://getcomposer.org/download/\" target=\"_blank\">https://getcomposer.org/download/</a> </li> <br> <li> <strong>Download the project source code:</strong><br> Clone the repository or extract the downloaded ZIP file to your desired directory. </li> <br> <li> <strong>Install PHP dependencies using Composer:</strong><br> Open a terminal in the project directory and run the following command: <pre><code>composer install</code></pre> </li> <br> <li> <strong>Start the PHP development server:</strong><br> Run the following command from the project root to start the server: <pre><code>php -S localhost:9000 public/index.php</code></pre> This will start the application on <code>http://localhost:9000</code> </li> <br> <li> <strong>Open the app in your browser:</strong><br> Navigate to: <a href=\"http://localhost:9000\" target=\"_blank\">http://localhost:9000</a> </li> </ol>', 14),
(3, 'How to stop the server from CMD line?', '<h3> If you started the server in the same terminal:</h3>\n<ul>\n    <li><strong>Focus</strong> on the terminal window where the server is running.</li>\n    <li><strong>Press <kbd>Ctrl</kbd> + <kbd>C</kbd></strong></li>\n    <ul>\n        <li>This sends a <code>SIGINT</code> (interrupt) signal to PHP and stops the server immediately.</li>\n        <li>You’ll see the terminal return to the normal prompt.</li>\n    </ul>\n</ul>', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
