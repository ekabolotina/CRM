<?php

/* footer.html.twig */
class __TwigTemplate_b30d12abdcdd2905bcfea8ba65c476de421026ad4ed70de0cba67a35473b6655 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<footer>
  <div class=\"container-fluid\">
    Powered by <a href=\"http://swat.one\" target=\"_blank\">SWAT</a>, 2017
    <div class=\"pull-right\">
      <a href=\"/feedback/\">Напишите нам</a>
    </div>
  </div>
</footer>
";
    }

    public function getTemplateName()
    {
        return "footer.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<footer>
  <div class=\"container-fluid\">
    Powered by <a href=\"http://swat.one\" target=\"_blank\">SWAT</a>, 2017
    <div class=\"pull-right\">
      <a href=\"/feedback/\">Напишите нам</a>
    </div>
  </div>
</footer>
", "footer.html.twig", "/home/ivan/WWW/CRM/src/views/footer.html.twig");
    }
}
