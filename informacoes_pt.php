<h1 class="h3 text-center mb-3">🔭 Metodologia de Detecção Preditiva Projeto <?= $GLOBALS['project']; ?></h1>
<p class="lead">O <strong><?= $GLOBALS['project']; ?></strong> utiliza um modelo de <strong>análise preditiva baseado em dados do catálogo TOI (TESS Objects of Interest)</strong> para estimar a <strong>probabilidade de um candidato ser um exoplaneta real</strong>. Diferente da detecção direta por <em>infravermelho (IR)</em> ou métodos fotométricos convencionais, nossa abordagem é <strong>estatística e inferencial</strong>, aplicando <strong>inteligência artificial e aprendizado de máquina</strong> sobre parâmetros físicos e orbitais.</p>

<hr class="my-4">
<h2 class="h5">⚙️ Processo de Análise</h2>
<ol class="mt-3">
    <li class="mb-2"><strong>Coleta e normalização dos dados TOI</strong><br>
        Os dados brutos provenientes da NASA são tratados para eliminar ruídos, duplicações e outliers, mantendo apenas colunas relevantes como <em>orbital_period, planet_radius, stellar_radius, transit_depth</em> e <em>disposition</em>.
    </li>
    <li class="mb-2"><strong>Atribuição de pesos métricos</strong><br>
        Cada parâmetro recebe um <strong>peso proporcional à sua correlação histórica</strong> com exoplanetas validados. Exemplo: <em>planet_radius</em> e <em>transit_depth</em> possuem maior influência, enquanto <em>stellar_temperature</em> e <em>ra/dec</em> (coordenadas) possuem peso menor, mas contribuem na análise espacial.
    </li>
    <li class="mb-2"><strong>Modelagem preditiva</strong><br>
        A função central aplica uma <strong>combinação ponderada dos parâmetros</strong> em uma equação probabilística otimizada (baseada em regressão logística e ajuste empírico dos pesos), retornando um valor percentual que representa a <strong>chance estimada de validação do candidato</strong>.
    </li>
    <li class="mb-2"><strong>Validação cruzada e consistência</strong><br>
        O modelo é testado contra registros de exoplanetas já confirmados e falsos positivos, medindo métricas como:
        <ul>
            <li><strong>Acurácia</strong></li>
            <li><strong>Precisão preditiva</strong></li>
            <li><strong>Taxa de falsos positivos</strong></li>
            <li><strong>Índice de correlação (R² ajustado)</strong></li>
        </ul>
        Essa validação contínua garante que o sistema aprenda e se ajuste com base em novas descobertas publicadas.
    </li>
</ol>

<h2 class="h5 mt-4">📊 Transparência e Métricas</h2>
<p>As porcentagens exibidas em cada candidato refletem:</p>
<ul>
    <li>A soma ponderada dos parâmetros analisados</li>
    <li>A calibração com base em exoplanetas validados pela NASA</li>
    <li>Um <strong>nível de confiança estatística</strong> definido pelo modelo</li>
</ul>
<p>Essa abordagem possibilita <strong>análises rápidas, replicáveis e cientificamente interpretáveis</strong>, oferecendo aos pesquisadores uma ferramenta de <strong>priorização inteligente</strong> para observações futuras.</p>

<blockquote class="blockquote mt-4">
    <p class="mb-0">O <?= $GLOBALS['project']; ?> não observa — ele <strong>pensa como um observatório</strong>. Nossa missão é transformar dados astronômicos em conhecimento preditivo, antecipando o olhar dos telescópios e ampliando as fronteiras da descoberta de exoplanetas.</p>
</blockquote>