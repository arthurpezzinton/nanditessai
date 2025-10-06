<?php
function deg2radf(float $deg): float { return $deg * M_PI / 180.0; }

/** Converte RA/Dec (em graus) + distância (pc) -> (x,y,z) */
function radec_to_xyz(float $ra_deg, float $dec_deg, ?float $dist_pc = null): array {
    // Se não houver distância, retorna vetor unitário (r = 1)
    $r = ($dist_pc === null) ? 1.0 : (float)$dist_pc;
    $ra  = deg2radf($ra_deg);
    $dec = deg2radf($dec_deg);
    $x = $r * cos($dec) * cos($ra);
    $y = $r * cos($dec) * sin($ra);
    $z = $r * sin($dec);
    return [$x,$y,$z];
}

/** Parseia "hh:mm:ss" -> graus (RA) */
function parse_rastr_to_deg(string $rastr): float {
    // aceita "hh mm ss" ou "hh:mm:ss"
    $t = preg_split('/[:\s]+/', trim($rastr));
    [$h,$m,$s] = array_map('floatval', array_pad($t, 3, 0));
    return 15.0 * ($h + $m/60.0 + $s/3600.0);
}

/** Parseia "±dd:mm:ss" -> graus (Dec) */
function parse_decstr_to_deg(string $decstr): float {
    $sgn = ($decstr[0] === '-') ? -1.0 : 1.0;
    $clean = ltrim($decstr, "+-");
    $t = preg_split('/[:\s]+/', trim($clean));
    [$d,$m,$s] = array_map('floatval', array_pad($t, 3, 0));
    return $sgn * ($d + $m/60.0 + $s/3600.0);
}

/** Exemplo usando uma linha vinda do PDO::FETCH_OBJ (toi_data) */
function toi_row_to_xyz(object $row): array {
    // Preferir numéricos se estiverem em graus corretos
    if (isset($row->ra) && isset($row->dec_) && abs($row->ra) <= 360 && abs($row->dec_) <= 90) {
        $ra_deg  = (float)$row->ra;
        $dec_deg = (float)$row->dec_;
    } else {
        // fallback: usar strings sexagesimais
        $ra_deg  = isset($row->rastr)  ? parse_rastr_to_deg($row->rastr)  : 0.0;
        $dec_deg = isset($row->decstr) ? parse_decstr_to_deg($row->decstr) : 0.0;
        // Se 'ra' numérico existir mas parecer escalado (ex.: 2.3e9), normalize:
        if (isset($row->ra) && abs($row->ra) > 360) {
            // exemplo comum: multiplicado por 1e7
            $guess = (float)$row->ra / 1.0e7;
            if (abs($guess) <= 360) $ra_deg = $guess;
        }
        if (isset($row->dec_) && abs($row->dec_) > 90) {
            $guess = (float)$row->dec_ / 1.0e7;
            if (abs($guess) <= 90) $dec_deg = $guess;
        }
    }

    // Distância em parsecs (se disponível)
    $dist_pc = isset($row->st_dist) ? (float)$row->st_dist : null;
    return radec_to_xyz($ra_deg, $dec_deg, $dist_pc);
}