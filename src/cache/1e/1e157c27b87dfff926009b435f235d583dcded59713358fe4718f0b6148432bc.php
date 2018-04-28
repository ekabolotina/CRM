<?php

/* base.html.twig */
class __TwigTemplate_f604cca0f43623043fdfb1a49f93e19de3d78f7b57d97debdc908cba4fa91e82 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'head_styles' => array($this, 'block_head_styles'),
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'foot_scripts' => array($this, 'block_foot_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"ru\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\"
        content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
  <title>";
        // line 8
        $this->displayBlock('page_title', $context, $blocks);
        echo "</title>
  ";
        // line 9
        $this->displayBlock('head_styles', $context, $blocks);
        // line 14
        echo "</head>
<body>
  ";
        // line 16
        $this->displayBlock('header', $context, $blocks);
        // line 19
        echo "
  ";
        // line 20
        $this->displayBlock('content', $context, $blocks);
        // line 22
        echo "
  ";
        // line 23
        $this->loadTemplate("footer.html.twig", "base.html.twig", 23)->display($context);
        // line 24
        echo "
  ";
        // line 25
        $this->displayBlock('foot_scripts', $context, $blocks);
        // line 30
        echo "</body>
</html>
";
    }

    // line 8
    public function block_page_title($context, array $blocks = array())
    {
        echo "Youch CRM";
    }

    // line 9
    public function block_head_styles($context, array $blocks = array())
    {
        // line 10
        echo "    <link rel=\"icon\" type=\"image/png\" href=\"/static/favicon.png?v=2.0\">
    <link rel=\"stylesheet\" href=\"/static/bootstrap/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"/static/css/global.css\">
  ";
    }

    // line 16
    public function block_header($context, array $blocks = array())
    {
        // line 17
        echo "    ";
        $this->loadTemplate("header.html.twig", "base.html.twig", 17)->display($context);
        // line 18
        echo "  ";
    }

    // line 20
    public function block_content($context, array $blocks = array())
    {
        // line 21
        echo "  ";
    }

    // line 25
    public function block_foot_scripts($context, array $blocks = array())
    {
        // line 26
        echo "    <script src=\"/static/js/lib/jquery-3.1.1.min.js\"></script>
    <script src=\"/static/bootstrap/js/bootstrap.min.js\"></script>
    <script src=\"/static/js/global.js\"></script>
  ";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 26,  103 => 25,  99 => 21,  96 => 20,  92 => 18,  89 => 17,  86 => 16,  79 => 10,  76 => 9,  70 => 8,  64 => 30,  62 => 25,  59 => 24,  57 => 23,  54 => 22,  52 => 20,  49 => 19,  47 => 16,  43 => 14,  41 => 9,  37 => 8,  28 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"ru\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\"
        content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
  <title>{% block page_title %}Youch CRM{% endblock page_title %}</title>
  {% block head_styles %}
    <link rel=\"icon\" type=\"image/png\" href=\"/static/favicon.png?v=2.0\">
    <link rel=\"stylesheet\" href=\"/static/bootstrap/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"/static/css/global.css\">
  {% endblock head_styles %}
</head>
<body>
  {% block header %}
    {% include 'header.html.twig' %}
  {% endblock header %}

  {% block content %}
  {% endblock content %}

  {% include 'footer.html.twig' %}

  {% block foot_scripts %}
    <script src=\"/static/js/lib/jquery-3.1.1.min.js\"></script>
    <script src=\"/static/bootstrap/js/bootstrap.min.js\"></script>
    <script src=\"/static/js/global.js\"></script>
  {% endblock foot_scripts %}
</body>
</html>
", "base.html.twig", "/home/ivan/WWW/CRM/src/views/base.html.twig");
    }
}
