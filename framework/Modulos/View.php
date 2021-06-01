<?php
namespace AlbertoCore\Modulos;
/**
 * Clase encargada de mostrar la vista recibida por la respone
 */
class View
{
   public function __invoke(string $viewname, array $data = [])
   {
      extract($data);
      if ($viewname){require_once($viewname);}
   }
}
?>