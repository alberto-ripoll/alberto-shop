<?php
namespace AlbertoCore\Modulos;
/**
 * Clase encargada de mostrar la vista recibida por la respone
 */
class View
{
   public function __invoke(string $viewname, array $data = [])
   {

      if (!file_exists($viewname))
      {
        throw new \Exception ('La plantilla '.$viewname.' no se encontrado');
      }

      extract($data);
      require_once($viewname);
   }
}
?>