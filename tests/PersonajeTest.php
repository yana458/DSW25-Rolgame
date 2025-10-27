<?php

use Dsw\Rolgame\Personaje;
use PHPUnit\Framework\TestCase; 

class PersonajeTest extends TestCase
{
  public function testAbstractPersonaje()
  {
    // Utilizamos ReflectionClass para obtener información de la clase
    $reflection = new ReflectionClass(Personaje::class);

    // Verificamos si la clase es abstracta
    $this->assertTrue($reflection->isAbstract(), 'La clase Personaje debe ser abstracta.');
  }

  public function testPersonajeTienePropiedades()
  {
      // Obtener la clase usando ReflectionClass
      $reflection = new ReflectionClass(Personaje::class);
      
      // Obtener las propiedades de la clase
      $properties = $reflection->getProperties();

      // Comprobamos que las propiedades concretas existen
      $propertyNames = array_map(function($property) {
          return $property->getName();
      }, $properties);

      $this->assertContains('nombre', $propertyNames, 'La clase Personaje debe tener la propiedad "nombre".');
      $this->assertContains('nivel', $propertyNames, 'La clase Personaje debe tener la propiedad "nivel".');
      $this->assertContains('puntosDeVida', $propertyNames, 'La clase Personaje debe tener la propiedad "puntosDeVida".');
  }

  public function testPersonajeTieneMetodos()
  {
      // Obtener la clase usando ReflectionClass
      $reflection = new ReflectionClass(Personaje::class);

      // Obtener los métodos de la clase
      $methods = $reflection->getMethods();

      // Separar los métodos concretos y abstractos
      $abstractMethods = [];
      $concreteMethods = [];

      foreach ($methods as $method) {
          if ($method->isAbstract()) {
              $abstractMethods[] = $method->getName();
          } else {
              $concreteMethods[] = $method->getName();
          }
      }

      // Verificar que existe un método abstracto llamado "atacar"
      $this->assertContains('atacar', $abstractMethods, 'La clase Personaje debe tener un método abstracto llamado "atacar".');
      $this->assertContains('defender', $abstractMethods, 'La clase Personaje debe tener un método abstracto llamado "defender".');

      // Verificar que existe un método concreto llamado "subirNivel"
      $this->assertContains('subirNivel', $concreteMethods, 'La clase Personaje debe tener un método concreto llamado "subirNivel".');
  }
}