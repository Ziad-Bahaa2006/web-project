<script type="text/javascript">
        var gk_isXlsx = false;
        var gk_xlsxFileLookup = {};
        var gk_fileData = {};
        function filledCell(cell) {
          return cell !== '' && cell != null;
        }
        function loadFileData(filename) {
        if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
            try {
                var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                // Convert sheet to JSON to filter blank rows
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
                // Filter out blank rows (rows where all cells are empty, null, or undefined)
                var filteredData = jsonData.filter(row => row.some(filledCell));

                // Heuristic to find the header row by ignoring rows with fewer filled cells than the next row
                var headerRowIndex = filteredData.findIndex((row, index) =>
                  row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
                );
                // Fallback
                if (headerRowIndex === -1 || headerRowIndex > 25) {
                  headerRowIndex = 0;
                }

                // Convert filtered JSON back to CSV
                var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex)); // Create a new sheet from filtered array of arrays
                csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                return csv;
            } catch (e) {
                console.error(e);
                return "";
            }
        }
        return gk_fileData[filename] || "";
        }
        </script>
        
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight Arena - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="stylehome.css">

</head>
<body>
    <header>
        <nav>
            <div class="logo">Fight Arena</div>
            <div class="nav-links">
                <a href="home_page.html"><i class="fas fa-home"></i> Home</a>
                <a href="../profile_page/profile.html"><i class="fas fa-user"></i> Profile</a>
                <a href="../game page (haitham)/gamepage.html"><i class="fas fa-gamepad"></i> Games</a>
                <a href="#leaderboard"><i class="fas fa-trophy"></i> Leaderboard</a>
                <a href="../About us/index.html"><i class="fas fa-info-circle"></i> About</a>
                <a href="../contact us page/contactus.html"><i class="fas fa-envelope"></i> Contact</a>
                <a href="login/login.html" onclick="login()"><i class="fas fa-sign-in-alt"></i> Login</a>
                <a href="../game page (haitham)/sign.html" onclick="signup()"><i class="fas fa-user-plus"></i> Sign Up</a>
                <div class="search-bar">
                    <input type="text" placeholder="Search games..." id="search-input">
                    <button onclick="searchGames()"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </nav>
    </header>

    <div class="hero">
        <div class="hero-slides">
            <div class="hero-slide">
                <div class="hero-content">
                    <h1>Welcome to Fight Arena</h1>
                    <p>Join the ultimate gaming community and dominate the leaderboards!</p>
                    <button class="cta-button" onclick="signup()"><i class="fas fa-user-plus"></i> Sign Up Now</button>
                </div>
            </div>
            <div class="hero-slide">
                <div class="hero-content">
                    <h1>BattleForge Awaits</h1>
                    <p>Dive into intense multiplayer battles with strategic depth!</p>
                    <button class="cta-button" onclick="playGame('BattleForge')"><i class="fas fa-gamepad"></i> Play Now</button>
                </div>
            </div>
            <div class="hero-slide">
                <div class="hero-content">
                    <h1>StarSniper Challenge</h1>
                    <p>Master precision shooting in this fast-paced FPS!</p>
                    <button class="cta-button" onclick="playGame('StarSniper')"><i class="fas fa-gamepad"></i> Play Now</button>
                </div>
            </div>
        </div>
        <div class="hero-nav">
            <span class="active" onclick="goToSlide(0)"></span>
            <span onclick="goToSlide(1)"></span>
            <span onclick="goToSlide(2)"></span>
        </div>
    </div>

    <div class="container">
<?php
// الاتصال بقاعدة البيانات
$host = 'localhost';
$dbname = 'games11';  // اسم قاعدة البيانات
$username = 'root';   // غالباً root
$password = '';       // في XAMPP بتكون فاضية

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// جلب الألعاب
$stmt = $pdo->query("SELECT * FROM games");
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="featured-games" id="games">
    <h2>Featured Games</h2>
    <div class="games-grid" id="games-grid">
        <?php foreach ($games as $game): ?>
            <div class="game-card" data-title="<?= htmlspecialchars($game['name']) ?>">
                <img src="https://via.placeholder.com/300x200" alt="<?= htmlspecialchars($game['name']) ?>">
                <div class="game-card-content">
                    <h3><?= htmlspecialchars($game['name']) ?></h3>
                    <p><?= htmlspecialchars($game['Description']) ?></p>
                    <p><strong>Price:</strong> $<?= htmlspecialchars($game['price']) ?></p>
                    <button onclick="playGame('<?= htmlspecialchars($game['name']) ?>')">Play Now</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <p class="no-results" id="no-results">No games found matching your search.</p>
</section>

<script>
    function playGame(gameTitle) {
        alert("Starting game: " + gameTitle);
    }
</script>

            <p class="no-results" id="no-results">No games found matching your search.</p>
        </section>

        <section class="news-section">
            <h2>Latest News</h2>
            <div class="news-grid">
                <div class="news-card">
                    <img src="https://via.placeholder.com/300x200" alt="News 1">
                    <div class="news-card-content">
                        <h3>BattleForge Update 2.0</h3>
                        <p>New maps and modes released! Dive into the action now.</p>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://via.placeholder.com/300x200" alt="News 2">
                    <div class="news-card-content">
                        <h3>StarSniper Tournament</h3>
                        <p>Join the global FPS tournament starting next week!</p>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://via.placeholder.com/300x200" alt="News 3">
                    <div class="news-card-content">
                        <h3>WarTactics Beta</h3>
                        <p>Sign up for the closed beta and test new features.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-section">
            <h2>Store</h2>
            <div class="store-grid">
                <div class="store-card">
                    <img src="https://via.placeholder.com/300x200" alt="Item 1">
                    <div class="store-card-content">
                        <h3>Epic BattleForge Skin</h3>
                        <p>Unlock a legendary skin for your BattleForge character.</p>
                        <div class="price">$9.99</div>
                        <button onclick="buyItem('Epic BattleForge Skin')">Buy Now</button>
                    </div>
                </div>
                <div class="store-card">
                    <img src="https://via.placeholder.com/300x200" alt="Item 2">
                    <div class="store-card-content">
                        <h3>StarSniper Credits</h3>
                        <p>500 in-game credits for weapon upgrades and cosmetics.</p>
                        <div class="price">$4.99</div>
                        <button onclick="buyItem('StarSniper Credits')">Buy Now</button>
                    </div>
                </div>
                <div class="store-card">
                    <img src="https://via.placeholder.com/300x200" alt="Item 3">
                    <div class="store-card-content">
                        <h3>Fight Arena T-Shirt</h3>
                        <p>Official merchandise to show your Fight Arena pride.</p>
                        <div class="price">$19.99</div>
                        <button onclick="buyItem('Fight Arena T-Shirt')">Buy Now</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="leaderboard-preview" id="leaderboard">
            <h2>Leaderboard Preview</h2>
            <div class="leaderboard-table">
                <table>
                    <tr>
                        <th>Rank</th>
                        <th>Player</th>
                        <th>Points</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>ProGamerX</td>
                        <td>25,430</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>ShadowSniper</td>
                        <td>22,150</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>TacticMaster</td>
                        <td>19,870</td>
                    </tr>
                </table>
            </div>
        </section>
    </div>

    <footer>
        <p>© 2025 Fight Arena. All rights reserved.</p>
        <div class="social-links">
            <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://discord.com" target="_blank"><i class="fab fa-discord"></i></a>
        </div>
    </footer>

    <script>
        function login() {
            alert('Login to your Fight Arena account!');
            // Replace with actual login logic or redirect
        }

        function signup() {
            alert('Sign up to join the Fight Arena community!');
            // Replace with actual signup logic or redirect
        }

        function playGame(gameName) {
            alert(`Starting ${gameName}! Get ready to play!`);
            // Replace with actual game launch logic
        }

        function buyItem(itemName) {
            alert(`Purchasing ${itemName}! Proceed to checkout.`);
            // Replace with actual purchase logic
        }

        function searchGames() {
            const query = document.getElementById('search-input').value.trim().toLowerCase();
            const gameCards = document.querySelectorAll('.game-card');
            const noResults = document.getElementById('no-results');
            let hasResults = false;

            gameCards.forEach(card => {
                const title = card.getAttribute('data-title').toLowerCase();
                if (query === '' || title.includes(query)) {
                    card.classList.remove('hidden');
                    hasResults = true;
                } else {
                    card.classList.add('hidden');
                }
            });

            noResults.style.display = hasResults ? 'none' : 'block';
        }

        let currentSlide = 0;
        const slides = document.querySelector('.hero-slides');
        const dots = document.querySelectorAll('.hero-nav span');

        function goToSlide(index) {
            currentSlide = index;
            slides.style.transform = `translateX(-${index * 33.33}%)`;
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        function autoSlide() {
            currentSlide = (currentSlide + 1) % 3;
            goToSlide(currentSlide);
        }

        setInterval(autoSlide, 5000);

        document.querySelector('.search-bar button').addEventListener('click', searchGames);
        document.getElementById('search-input').addEventListener('input', searchGames);
        document.getElementById('search-input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') searchGames();
        });
    </script>
</body>
</html>