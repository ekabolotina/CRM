<?php

/* header.html.twig */
class __TwigTemplate_ac03cd7134ea891372cec7e36725932f5ef2b0f7f248c4d08f2854d6ab6154e3 extends Twig_Template
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
        echo "<nav class=\"navbar navbar-default\" role=\"navigation\">
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <a class=\"navbar-brand\" href=\"/\"><img src=\"/static/favicon.png\" style=\"height: 20px; float: left; margin-right: 10px;\">Youch CRM</a>
    </div>
    <ul class=\"nav navbar-nav\">
      <li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Заказы <b class=\"caret\"></b></a>
        <ul class=\"dropdown-menu\">
          <li><a href=\"/order/new\">Новый</a></li>
          <li><a href=\"/order/all\">Все заказы</a></li>
        </ul>
      </li>
      <li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Автомобили <b class=\"caret\"></b></a>
        <ul class=\"dropdown-menu\">
          <li><a href=\"/auto/add\">Новый</a></li>
          <li><a href=\"/auto/all\">Все автомобили</a></li>
          <li><a href=\"/auto/create\">Добавить модель</a></li>
        </ul>
      </li>
      <li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Клиенты <b class=\"caret\"></b></a>
        <ul class=\"dropdown-menu\">
          <li><a href=\"/clients/add\">Новый</a></li>
          <li><a href=\"/clients/all\">Все клиенты</a></li>
        </ul>
      </li>
      <li><a href=\"/settings\">Настройки</a></li>
    </ul>
    <ul class=\"nav navbar-nav navbar-right\">
      <li><a href=\"#\" id=\"logout\">Выйти</a></li>
    </ul>
  </div>
</nav>
";
    }

    public function getTemplateName()
    {
        return "header.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"navbar navbar-default\" role=\"navigation\">
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <a class=\"navbar-brand\" href=\"/\"><img src=\"/static/favicon.png\" style=\"height: 20px; float: left; margin-right: 10px;\">Youch CRM</a>
    </div>
    <ul class=\"nav navbar-nav\">
      <li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Заказы <b class=\"caret\"></b></a>
        <ul class=\"dropdown-menu\">
          <li><a href=\"/order/new\">Новый</a></li>
          <li><a href=\"/order/all\">Все заказы</a></li>
        </ul>
      </li>
      <li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Автомобили <b class=\"caret\"></b></a>
        <ul class=\"dropdown-menu\">
          <li><a href=\"/auto/add\">Новый</a></li>
          <li><a href=\"/auto/all\">Все автомобили</a></li>
          <li><a href=\"/auto/create\">Добавить модель</a></li>
        </ul>
      </li>
      <li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Клиенты <b class=\"caret\"></b></a>
        <ul class=\"dropdown-menu\">
          <li><a href=\"/clients/add\">Новый</a></li>
          <li><a href=\"/clients/all\">Все клиенты</a></li>
        </ul>
      </li>
      <li><a href=\"/settings\">Настройки</a></li>
    </ul>
    <ul class=\"nav navbar-nav navbar-right\">
      <li><a href=\"#\" id=\"logout\">Выйти</a></li>
    </ul>
  </div>
</nav>
", "header.html.twig", "/home/ivan/WWW/CRM/src/views/header.html.twig");
    }
}
