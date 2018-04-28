<?php

/* main/index.html.twig */
class __TwigTemplate_6b2333729ccccd5a201c8357ee03d0b4e800b6f63671cb9b7a119c1757c2d545 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "main/index.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
  <div class=\"container-fluid\">
    <h2>Добро пожаловать. Вы вошли как <b>&laquo;";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "name", array()), "html", null, true);
        echo "&raquo;.</b></h2>

    <hr>

    <h3>С чего начать?</h3>
    <ul>
      <li><a href=\"/settings\">Заполните свой профиль</a></li>
      <li><a href=\"/auto/add\">Добавьте автомобиль</a></li>
      <li><a href=\"/order/new\">Создайте новый заказ</a></li>
    </ul>

    <hr>

    <h3>Сейчас в системе</h3>
    <ul>
      <li>Автомобилей <b>";
        // line 21
        echo twig_escape_filter($this->env, ($context["cars_count"] ?? null), "html", null, true);
        echo "</b></li>
      <li>Клиентов <b>";
        // line 22
        echo twig_escape_filter($this->env, ($context["clients_count"] ?? null), "html", null, true);
        echo "</b></li>
      <li>Заказов <b>";
        // line 23
        echo twig_escape_filter($this->env, ($context["orders_count"] ?? null), "html", null, true);
        echo "</b></li>
    </ul>
  </div>

";
    }

    public function getTemplateName()
    {
        return "main/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 23,  61 => 22,  57 => 21,  39 => 6,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'base.html.twig' %}

{% block content %}

  <div class=\"container-fluid\">
    <h2>Добро пожаловать. Вы вошли как <b>&laquo;{{ user.name }}&raquo;.</b></h2>

    <hr>

    <h3>С чего начать?</h3>
    <ul>
      <li><a href=\"/settings\">Заполните свой профиль</a></li>
      <li><a href=\"/auto/add\">Добавьте автомобиль</a></li>
      <li><a href=\"/order/new\">Создайте новый заказ</a></li>
    </ul>

    <hr>

    <h3>Сейчас в системе</h3>
    <ul>
      <li>Автомобилей <b>{{ cars_count }}</b></li>
      <li>Клиентов <b>{{ clients_count }}</b></li>
      <li>Заказов <b>{{ orders_count }}</b></li>
    </ul>
  </div>

{% endblock content %}", "main/index.html.twig", "/home/ivan/WWW/CRM/src/views/main/index.html.twig");
    }
}
