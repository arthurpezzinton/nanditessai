<?php
/**
 * Logistic regression model for exoplanet confirmation probability.
 * Embedded coefficients and scaler parameters.
 */

class ExoplanetLogisticModel {
    private const INTERCEPT = -0.8073774617710762;

    private const COEFS = [
        'pl_trandurherr1' => -1.673103046154,
        'pl_trandurherr2' => 1.673103046154,
        'st_rad' => -0.797158007155,
        'st_teff' => -0.776978868685,
        'pl_insol' => -0.649926683733,
        'st_tmag' => -0.512665578448,
        'pl_trandurh' => 0.462437961379,
        'pl_orbper' => -0.407845193873,
        'pl_tranmiderr1' => -0.344568932676,
        'pl_tranmiderr2' => 0.344568932676,
        'pl_rade' => 0.337897832482,
        'st_tmagerr2' => 0.275240119280,
        'st_tmagerr1' => -0.275240119280,
        'st_pmdecerr1' => -0.202761972041,
        'st_pmdecerr2' => 0.202761972041,
        'pl_trandep' => 0.187223184253,
        'st_raderr1' => -0.186699005648,
        'st_raderr2' => 0.186699005648,
        'dec_' => 0.165623531972,
        'pl_trandeperr1' => -0.163628132371,
        'pl_trandeperr2' => 0.163628132371,
        'pl_tranmid' => 0.156986174219,
        'ra' => 0.153158787374,
        'st_pmdec' => -0.149221793176,
        'pl_radeerr2' => 0.149022321960,
        'pl_radeerr1' => -0.149022321960,
        'pl_pnum' => 0.133726954687,
        'st_disterr1' => -0.122893789111,
        'st_disterr2' => 0.122893789111,
        'pl_eqt' => 0.117329491546,
        'st_pmraerr2' => 0.104742197706,
        'st_pmraerr1' => -0.104742197706,
        'tid' => -0.102921268755,
        'ctoi_alias' => -0.102921268753,
        'st_loggerr1' => -0.059357118067,
        'st_loggerr2' => 0.059357118067,
        'st_tefferr2' => 0.046802870007,
        'st_tefferr1' => -0.046802870007,
        'pl_orbpererr1' => 0.041478754450,
        'pl_orbpererr2' => -0.041478754450,
        'st_dist' => -0.031341153542,
        'st_pmra' => 0.030465610160,
        'st_logg' => 0.007590118097
    ];

    private const SCALER = [
        'tid' => [ 'median' => 243735836.000000000000, 'mean' => 243768462.389331489801, 'std' => 157794074.650328785181 ],
        'ctoi_alias' => [ 'median' => 24373583601.000000000000, 'mean' => 24376846239.983200073242, 'std' => 15779407465.034156799316 ],
        'pl_pnum' => [ 'median' => 1.000000000000, 'mean' => 1.050051957049, 'std' => 0.272429887706 ],
        'ra' => [ 'median' => 1630437405.000000000000, 'mean' => 1802543500.555940389633, 'std' => 1035477145.437181234360 ],
        'dec_' => [ 'median' => 39749345.000000000000, 'mean' => 8532516.359542777762, 'std' => 472900127.205881357193 ],
        'st_pmra' => [ 'median' => -15850000.000000000000, 'mean' => -6423709.733287149109, 'std' => 695454654.552384138107 ],
        'st_pmraerr1' => [ 'median' => 46.000000000000, 'mean' => 147.289227571874, 'std' => 459.423750707212 ],
        'st_pmraerr2' => [ 'median' => -46.000000000000, 'mean' => -147.289227571874, 'std' => 459.423750707212 ],
        'st_pmdec' => [ 'median' => -34620000.000000000000, 'mean' => -91112705.230342924595, 'std' => 632505275.797082781792 ],
        'st_pmdecerr1' => [ 'median' => 46.000000000000, 'mean' => 140.600623484586, 'std' => 445.921362605111 ],
        'st_pmdecerr2' => [ 'median' => -46.000000000000, 'mean' => -140.600623484586, 'std' => 445.921362605111 ],
        'pl_tranmid' => [ 'median' => 24595777928240.000000000000, 'mean' => 24595478595028.527343750000, 'std' => 6181782986.243142127991 ],
        'pl_tranmiderr1' => [ 'median' => 2032.000000000000, 'mean' => 3796.506754416349, 'std' => 49505.712498123597 ],
        'pl_tranmiderr2' => [ 'median' => -2032.000000000000, 'mean' => -3796.506754416349, 'std' => 49505.712498123597 ],
        'pl_orbper' => [ 'median' => 40670596.000000000000, 'mean' => 178874208.551610678434, 'std' => 980776770.201452374458 ],
        'pl_orbpererr1' => [ 'median' => 2498.500000000000, 'mean' => 4006.168167648078, 'std' => 9482.247187823428 ],
        'pl_orbpererr2' => [ 'median' => -2498.500000000000, 'mean' => -4006.168167648078, 'std' => 9482.247187823428 ],
        'pl_trandurh' => [ 'median' => 27235939.500000000000, 'mean' => 30576281.750779360533, 'std' => 18938696.252472564578 ],
        'pl_trandurherr1' => [ 'median' => 2630000.000000000000, 'mean' => 3685682.488049879204, 'std' => 22219667.476994488388 ],
        'pl_trandurherr2' => [ 'median' => -2630000.000000000000, 'mean' => -3685682.488049879204, 'std' => 22219667.476994488388 ],
        'pl_trandep' => [ 'median' => 47292370473.500000000000, 'mean' => 83454004645.095077514648, 'std' => 191577500408.548278808594 ],
        'pl_trandeperr1' => [ 'median' => 728346400.000000000000, 'mean' => 4864906997.597506523132, 'std' => 22126482664.811981201172 ],
        'pl_trandeperr2' => [ 'median' => -728346400.000000000000, 'mean' => -4864906997.597506523132, 'std' => 22126482664.811981201172 ],
        'pl_rade' => [ 'median' => 105624000.000000000000, 'mean' => 104024894.747835114598, 'std' => 89004205.830002680421 ],
        'pl_radeerr1' => [ 'median' => 7229480.000000000000, 'mean' => 13026968.837547628209, 'std' => 28425053.593760963529 ],
        'pl_radeerr2' => [ 'median' => -7229480.000000000000, 'mean' => -13026968.837547628209, 'std' => 28425053.593760963529 ],
        'pl_insol' => [ 'median' => 3667580000.000000000000, 'mean' => 22484550563.870281219482, 'std' => 110582614144.404235839844 ],
        'pl_eqt' => [ 'median' => 11850239229.000000000000, 'mean' => 12814196661.467439651489, 'std' => 6756073297.312345504761 ],
        'st_tmag' => [ 'median' => 118220500.000000000000, 'mean' => 115506209.812954619527, 'std' => 16426010.097457107157 ],
        'st_tmagerr1' => [ 'median' => 6.000000000000, 'mean' => 8.376342223762, 'std' => 13.432915904984 ],
        'st_tmagerr2' => [ 'median' => -6.000000000000, 'mean' => -8.376342223762, 'std' => 13.432915904984 ],
        'st_dist' => [ 'median' => 3664050000.000000000000, 'mean' => 4726378153.758226394653, 'std' => 5442629549.703883171082 ],
        'st_disterr1' => [ 'median' => 42742500.000000000000, 'mean' => 179336393.190162807703, 'std' => 1337393148.203839302063 ],
        'st_disterr2' => [ 'median' => -42742500.000000000000, 'mean' => -179336393.190162807703, 'std' => 1337393148.203839302063 ],
        'st_teff' => [ 'median' => 58005500000.000000000000, 'mean' => 57884323657.776237487793, 'std' => 14080209931.763080596924 ],
        'st_tefferr1' => [ 'median' => 1291000000.000000000000, 'mean' => 1986381754.225840091705, 'std' => 5264185686.431049346924 ],
        'st_tefferr2' => [ 'median' => -1291000000.000000000000, 'mean' => -1986381754.225840091705, 'std' => 5264185686.431049346924 ],
        'st_logg' => [ 'median' => 43300000.000000000000, 'mean' => 43061693.141669556499, 'std' => 2869846.065020168666 ],
        'st_loggerr1' => [ 'median' => 853711.000000000000, 'mean' => 1477291.330966401147, 'std' => 2953836.592324361671 ],
        'st_loggerr2' => [ 'median' => -853711.000000000000, 'mean' => -1477291.330966401147, 'std' => 2953836.592324361671 ],
        'st_rad' => [ 'median' => 12354250.000000000000, 'mean' => 14104076.835469344631, 'std' => 17374932.701276354492 ],
        'st_raderr1' => [ 'median' => 600000.000000000000, 'mean' => 717640.175095254555, 'std' => 761874.740744916489 ],
        'st_raderr2' => [ 'median' => -600000.000000000000, 'mean' => -717640.175095254555, 'std' => 761874.740744916489 ]
    ];

    private static function toNumber($v) {
        if ($v === null) return null;
        if (is_float($v) || is_int($v)) return (float)$v;
        $s = trim((string)$v);
        if ($s === '') return null;
        if (preg_match('/[A-Za-z]/', $s)) return null;
        $s = str_replace(' ', '', $s);
        $s = str_replace('.', '', $s);
        $s = str_replace(',', '.', $s);
        return is_numeric($s) ? (float)$s : null;
    }

    private static function sigmoid(float $x): float {
        if ($x < -35.0) return 0.0;
        if ($x >  35.0) return 1.0;
        return 1.0 / (1.0 + exp(-$x));
    }

    public static function predictProba(array $row): float {
        $logit = self::INTERCEPT;

        foreach (self::SCALER as $feat => $p) {
            $raw = $row[$feat] ?? null;
            $val = self::toNumber($raw);
            $median = $p['median'] ?? null;
            $mean   = $p['mean']   ?? null;
            $std    = $p['std']    ?? null;

            if ($val === null) $val = $median;
            $z = 0.0;
            if ($val !== null && $mean !== null && $std !== null && $std != 0.0) {
                $z = ($val - $mean) / $std;
            }
            if (isset(self::COEFS[$feat])) {
                $logit += self::COEFS[$feat] * $z;
            }
        }

        foreach (self::COEFS as $key => $coef) {
            if (strpos($key, '__') === false) continue;
            [$col, $val] = explode('__', $key, 2);
            if ($col === '' || $val === '') continue;
            if (!array_key_exists($col, $row)) continue;
            $v = $row[$col];
            $v = $v === null ? '' : (string)$v;
            if ($v === $val || trim($v) === $val) {
                $logit += $coef;
            }
        }

        return self::sigmoid($logit);
    }

    public static function predictPercent(array $row): float {
        return round(self::predictProba($row) * 100.0, 2);
    }
}

function score_exoplanet_percent(array $row): float {
    return ExoplanetLogisticModel::predictPercent($row);
}
?>
