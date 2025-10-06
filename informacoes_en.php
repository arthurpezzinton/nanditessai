<h1 class="h3 text-center mb-3">🔭 Predictive Detection Methodology - <?= $GLOBALS['project']; ?> Project</h1>
<p class="lead"><strong><?= $GLOBALS['project']; ?></strong> employs a <strong>predictive analytics model trained on TOI (TESS Objects of Interest) data</strong> to estimate the <strong>probability that a given candidate is a real exoplanet</strong>. Unlike direct <em>infrared (IR)</em> detection or conventional photometric methods, our approach is <strong>statistical and inferential</strong>, applying <strong>artificial intelligence and machine learning</strong> to physical and orbital parameters.</p>

<hr class="my-4">
<h2 class="h5">⚙️ Analysis Pipeline</h2>
<ol class="mt-3">
    <li class="mb-2"><strong>TOI data ingestion and normalization</strong><br>
        Raw NASA records are cleaned to remove noise, duplicates, and outliers, retaining relevant columns such as <em>orbital_period, planet_radius, stellar_radius, transit_depth</em>, and <em>disposition</em>.
    </li>
    <li class="mb-2"><strong>Metric weighting</strong><br>
        Each parameter receives a <strong>weight proportional to its historical correlation</strong> with validated exoplanets. For example, <em>planet_radius</em> and <em>transit_depth</em> exert higher influence, while <em>stellar_temperature</em> and <em>ra/dec</em> (coordinates) carry lower weight yet contribute to spatial context.
    </li>
    <li class="mb-2"><strong>Predictive modeling</strong><br>
        The core function applies a <strong>weighted combination of parameters</strong> within an optimized probabilistic equation (logistic regression with empirically tuned weights), returning a percentage that represents the <strong>estimated chance of candidate validation</strong>.
    </li>
    <li class="mb-2"><strong>Cross-validation and consistency</strong><br>
        The model is tested against records of confirmed exoplanets and false positives, tracking metrics such as:
        <ul>
            <li><strong>Accuracy</strong></li>
            <li><strong>Predictive precision</strong></li>
            <li><strong>False-positive rate</strong></li>
            <li><strong>Adjusted R²</strong></li>
        </ul>
        Continuous validation ensures the system learns and recalibrates as new discoveries are published.
    </li>
</ol>

<h2 class="h5 mt-4">📊 Transparency &amp; Metrics</h2>
<p>The displayed percentages for each candidate reflect:</p>
<ul>
    <li>The weighted sum of analyzed parameters</li>
    <li>Calibration using NASA-validated exoplanets</li>
    <li>A <strong>model-level statistical confidence</strong></li>
</ul>
<p>This enables <strong>fast, reproducible, and scientifically interpretable</strong> assessments, giving researchers a tool for <strong>smart prioritization</strong> of future observations.</p>

<blockquote class="blockquote mt-4">
    <p class="mb-0"><?= $GLOBALS['project']; ?> does't merely observe — it <strong>thinks like an observatory</strong>. Our mission is to transform astronomical data into predictive insight, anticipating telescope time and broadening the frontier of exoplanet discovery.</p>
</blockquote>