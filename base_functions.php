<?php
$project = "NandiTESS.ai";
$items_per_page = 25;
$language_cookie = sha1("language_cookie_nanditess");
$bot_cookie = sha1("bot_cookie_nanditess");
$language_cookie_duration_seconds = 15 * 60 * 60 * 24;
require 'translates.php';
require 'exoplanet_model_single_file.php';
require 'conversao.php';

function get_base_css($insider = false)
{
    $file_list = array("bootstrap", "bootstrap-icons", "google-fonts", "notify-animation");
    $return_text = "<link rel='icon' type='image/x-icon' href='" . ($insider ? "../" : "") . "images/icon.png'>";
    $return_text .= "<link rel='apple-touch-icon' type='image/x-icon' href='" . ($insider ? "../" : "") . "images/icon.png'>";
    for ($ind = 0; $ind < sizeof($file_list); $ind++) {
        $return_text .= "<link rel='stylesheet' href='" . ($insider ? "../" : "") . "libs/" . $file_list[$ind] . ".css'>";
    }
    $return_text .= "<link rel='stylesheet' href='" . ($insider ? "../" : "") . "libs/main.css?now=" . date('Ymdh') . "'>";
    echo $return_text;
}

function get_base_js($insider = false)
{
    $file_list = array("jquery", "bootstrap", "echarts", "echarts_gl", "extenso", "notify", "dselect");
    $return_text = "";
    for ($ind = 0; $ind < sizeof($file_list); $ind++) {
        $return_text .= "<script type='text/javascript' src='" . ($insider ? "../" : "") . "libs/" . $file_list[$ind] . ".js'></script>";
    }
    $return_text .= "<script type='text/javascript' src='" . ($insider ? "../" : "") . "libs/main.js?now=" . date('Ymdh') . "'></script>";
    echo $return_text;
}

$team = array(
    "dante" => array(
        "nome" => "DANTE",
        "funcao" => get_translation("quantum_physics"),
        "foto" => "",
    ),
    "joedge" => array(
        "nome" => "JOEDGE",
        "funcao" => get_translation("artificial_intelligence"),
        "foto" => "",
    ),
    "ana" => array(
        "nome" => "ANA LUIZA",
        "funcao" => get_translation("astrobiology"),
        "foto" => "",
    ),
    "davi" => array(
        "nome" => "DAVI",
        "funcao" => get_translation("researcher_and_translator"),
        "foto" => "",
    ),
    "vinicius" => array(
        "nome" => "VINICIUS",
        "funcao" => get_translation("mathematics"),
        "foto" => "",
    ),
    "arthur" => array(
        "nome" => "ARTHUR",
        "funcao" => get_translation("development"),
        "foto" => "",
    ),
);

$type_labels = array(
    array(
        "value" => "all",
        "nick" => strtoupper(get_translation("all")),
        "text" => get_translation("all"),
    ),
    array(
        "value" => "pc",
        "nick" => "PC",
        "text" => get_translation("pc"),
    ),
    array(
        "value" => "cp",
        "nick" => "CP",
        "text" => get_translation("cp"),
    ),
    array(
        "value" => "kp",
        "nick" => "KP",
        "text" => get_translation("kp"),
    ),
    array(
        "value" => "fp",
        "nick" => "FP",
        "text" => get_translation("fp"),
    ),
    array(
        "value" => "fa",
        "nick" => "FA",
        "text" => get_translation("fa"),
    ),
    array(
        "value" => "apc",
        "nick" => "APC",
        "text" => get_translation("apc"),
    )
);

function get_percent_by_line($line)
{
    $row = [
        'tid' => floatval($line->tid),
        'ctoi_alias' => floatval($line->ctoi_alias),
        'pl_pnum' => floatval($line->pl_pnum),
        'ra' => floatval($line->ra),
        'dec_' => floatval($line->dec_),
        'st_pmra' => floatval($line->st_pmra),
        'st_pmraerr1' => floatval($line->st_pmraerr1),
        'st_pmraerr2' => floatval($line->st_pmraerr2),
        'st_pmdec' => floatval($line->st_pmdec),
        'st_pmdecerr1' => floatval($line->st_pmdecerr1),
        'st_pmdecerr2' => floatval($line->st_pmdecerr2),
        'pl_tranmid' => floatval($line->pl_tranmid),
        'pl_tranmiderr1' => floatval($line->pl_tranmiderr1),
        'pl_tranmiderr2' => floatval($line->pl_tranmiderr2),
        'pl_orbper' => floatval($line->pl_orbper),
        'pl_orbpererr1' => floatval($line->pl_orbpererr1),
        'pl_orbpererr2' => floatval($line->pl_orbpererr2),
        'pl_trandurh' => floatval($line->pl_trandurh),
        'pl_trandurherr1' => floatval($line->pl_trandurherr1),
        'pl_trandurherr2' => floatval($line->pl_trandurherr2),
        'pl_trandep' => floatval($line->pl_trandep),
        'pl_trandeperr1' => floatval($line->pl_trandeperr1),
        'pl_trandeperr2' => floatval($line->pl_trandeperr2),
        'pl_rade' => floatval($line->pl_rade),
        'pl_radeerr1' => floatval($line->pl_radeerr1),
        'pl_radeerr2' => floatval($line->pl_radeerr2),
        'pl_insol' => floatval($line->pl_insol),
        'pl_eqt' => floatval($line->pl_eqt),
        'st_tmag' => floatval($line->st_tmag),
        'st_tmagerr1' => floatval($line->st_tmagerr1),
        'st_tmagerr2' => floatval($line->st_tmagerr2),
        'st_dist' => floatval($line->st_dist),
        'st_disterr1' => floatval($line->st_disterr1),
        'st_disterr2' => floatval($line->st_disterr2),
        'st_teff' => floatval($line->st_teff),
        'st_tefferr1' => floatval($line->st_tefferr1),
        'st_tefferr2' => floatval($line->st_tefferr2),
        'st_logg' => floatval($line->st_logg),
        'st_loggerr1' => floatval($line->st_loggerr1),
        'st_loggerr2' => floatval($line->st_loggerr2),
        'st_rad' => floatval($line->st_rad),
        'st_raderr1' => floatval($line->st_raderr1),
        'st_raderr2' => floatval($line->st_raderr2),
    ];
    return score_exoplanet_percent($row);
}

function set_language($language)
{
    setcookie($GLOBALS['language_cookie'], $language, time() + ($GLOBALS['language_cookie_duration_seconds']), "/", httponly: true);
}

function set_bot_visible($visible)
{
    setcookie($GLOBALS['bot_cookie'], $visible, time() + ($GLOBALS['language_cookie_duration_seconds']), "/", httponly: true);
}

function get_bot_cookie(){
    $visible = false;
    if(isset($_COOKIE[$GLOBALS['bot_cookie']])) $visible = $_COOKIE[$GLOBALS['bot_cookie']] == "true";
    return $visible;
}

function get_error_message($code)
{
    if ($code) {
        switch ($code) {
            case 400:
                return get_translation('error_obtaining_data');
            case 403:
                return "Parâmetro inválido.";
                /*
            case 401:
                return "Erro de autenticação.";
            
            case 404:
                return "Arquivo inválido.";
            case 405:
                return "Tipo de arquivo inválido. Aceita somente PDF.";
            case 501:
                return "<b>CPF</b> ou <b>Senha</b> inválidos.";
            case 502:
                return "<b>Nome</b> inválido";
            case 503:
                return "<b>CPF</b> inválido";
            case 504:
                return "<b>E-mail</b> inválido";
            case 505:
                return "<b>CPF</b> já cadastrado";
            case 506:
                return "<b>E-mail</b> já cadastrado";
            case 507:
                return "Tipo de arquivo inválido. Aceita somente imagens e PDFs.";
            case 508:
                return "<b>Telefone</b> inválido";
                */
            default:
                return get_translation('error');
        }
    } else {
        return "";
    }
}

function get_error_response($code, $id = null)
{
    $error = array(
        "message" => get_error_message($code),
        "id" => $id
    );

    return $error;
}

function set_error_return($http_code = 400, $code = 400, $id = null)
{
    http_response_code($http_code);
    echo json_encode(get_error_response($code, $id));
}

function set_success_return($data = true)
{
    http_response_code(200);
    echo json_encode($data);
}

function get_data($search = null, $filter = "all")
{
    $blog = crudBlog::getInstance(Conexao::getInstance());

    $where = " 1 ";
    $parameters = array();

    if ($search != null && !empty($search)) {
        $where .= " AND td.toi LIKE ? ";
        array_push($parameters, "%" . $search . "%");
    }

    if ($filter != null && !empty($filter) && $filter != "ALL") {
        $where .= " AND td.tfopwg_disp = ? ";
        array_push($parameters, $filter);
    }

    $amount = $blog->execute_search("SELECT COUNT(*) AS amount FROM toi_data td WHERE " . $where . " ORDER BY td.id ", $parameters, true);

    $avg = $blog->execute_search("SELECT AVG(td.percentual) AS avg_calculated FROM toi_data td WHERE td.tfopwg_disp = 'CP' OR td.tfopwg_disp = 'KP' ", array(), true);

    $amount_over_avg = $blog->execute_search("SELECT COUNT(*) AS amount_over_avg FROM toi_data td WHERE " . $where . " AND td.percentual >= " . floatval($avg->avg_calculated) . " ORDER BY td.id ", $parameters, true);

    $data = $blog->execute_search("SELECT *, IF(td.percentual >= " . floatval($avg->avg_calculated) . ", 1, 0) AS over_avg FROM toi_data td WHERE " . $where . " ORDER BY td.id ", $parameters);

    $dados = array(
        "data" => $data,
        "amount" => $amount->amount,
        "amount_percentual" => number_format(100*$amount_over_avg->amount_over_avg/$amount->amount,2),
        "amount_over_avg" => $amount_over_avg->amount_over_avg,
        "avg" => number_format($avg->avg_calculated,2)
    );

    return $dados;
}

function submit_theory($nome,$titulo,$descricao,$hipotese,$metodologia,$resultados)
{
    $blog = crudBlog::getInstance(Conexao::getInstance());

    $dados = $blog->submit_theory($nome,$titulo,$descricao,$hipotese,$metodologia,$resultados);

    return $dados;
}

function get_stars($search)
{
    $blog = crudBlog::getInstance(Conexao::getInstance());

    $where = " 1 ";
    $parameters = array();

    if ($search != null && !empty($search)) {
        $where .= " AND e.nome LIKE ? ";
        array_push($parameters, "%" . $search . "%");
    }

    $data = $blog->execute_search("SELECT * FROM estrelas e WHERE " . $where . " ORDER BY e.id ", $parameters);

    $dados = array(
        "data" => $data
    );

    return $dados;
}

function get_planets($star)
{
    $blog = crudBlog::getInstance(Conexao::getInstance());

    $where = " p.estrela = ? ";
    $parameters = array($star);

    $data = $blog->execute_search("SELECT * FROM planetas p WHERE " . $where . " ORDER BY p.id ", $parameters);

    $dados = array(
        "data" => $data
    );

    return $dados;
}


class crudBlog
{
    private $pdo = null;

    private static $crudBlog = null;

    private function __construct($conexao)
    {
        $this->pdo = $conexao;
    }

    public static function getInstance($conexao)
    {
        if (!isset(self::$crudBlog)):
            self::$crudBlog = new crudBlog($conexao);
        endif;
        return self::$crudBlog;
    }

    public function execute_search($query, $parameters, $unique = false)
    {
        try {
            $stm = $this->pdo->prepare($query);
            $parameter_count = 0;
            foreach ($parameters as $parameter):
                $parameter_count++;
                $stm->bindValue($parameter_count, $parameter);
            endforeach;
            $stm->execute();
            if ($unique == true) $dados = $stm->fetch(PDO::FETCH_OBJ);
            else $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (PDOException $erro) {
            //echo "<script type='text/javascript'>alert('Erro na linha: {$erro->getLine()}')</script>";
            return false;
        }
    }

    public function update_percentual($id, $value)
    {
        try {
            $stm = $this->pdo->prepare("UPDATE toi_data SET percentual=? WHERE id=? LIMIT 1");
            $stm->bindValue(1, $value);
            $stm->bindValue(2, $id);
            $stm->execute();
            return true;
        } catch (PDOException $erro) {
            //echo "<script type='text/javascript'>alert('Erro na linha: {$erro->getLine()}')</script>";
            return false;
        }
    }

    public function update_item($table = null, $alterations = array(), $where = null, $limit = true)
    {
        try {
            $query = "UPDATE " . $table . " SET ";
            $alteration_counter = 0;
            foreach ($alterations as $alteration):
                if ($alteration_counter == 0) $query .= ", ";
                $query .= $alteration->parameter . " = ?";
                $alteration_counter++;
            endforeach;
            $query .= " WHERE " . $where;
            if ($limit) $query .= " LIMIT 1";
            $stm = $this->pdo->prepare($query);
            $alteration_counter = 0;
            foreach ($alterations as $alteration):
                $alteration_counter++;
                $stm->bindValue($alteration_counter, $alteration->value);
            endforeach;
            $stm->execute();
            return true;
        } catch (PDOException $erro) {
            //echo "<script type='text/javascript'>alert('Erro na linha: {$erro->getLine()}')</script>";
            return false;
        }
    }

    public function submit_theory($nome,$titulo,$descricao,$hipotese,$metodologia,$resultados)
    {
        try {
            $stm = $this->pdo->prepare("INSERT INTO teorias VALUES (0,?,?,?,?,?,?,NOW())");
            $stm->bindValue(1, $nome);
            $stm->bindValue(2, $titulo);
            $stm->bindValue(3, $descricao);
            $stm->bindValue(4, $hipotese);
            $stm->bindValue(5, $metodologia);
            $stm->bindValue(6, $resultados);
            $stm->execute();
            return true;
        } catch (PDOException $erro) {
            //echo "<script type='text/javascript'>alert('Erro na linha: {$erro->getLine()}')</script>";
            return false;
        }
    }
}
