# Hasta 10 respuestas por encuesta

No ha pasado ni un día desde el lanzamiento y ya estoy agregando nuevas funcionalidades a Terrific Poll para seguir mejorando la experiencia de usuario.

Hasta ahora, las encuestas solo permitían hasta 2 opciones de respuesta por encuesta. Sin embargo, a partir de hoy, puedes añadir hasta 10 respuestas en cada encuesta. Consideré permitir un número ilimitado de respuestas, pero seamos realistas: nadie quiere contestar una encuesta con demasiadas opciones. Incluso 10 pueden ser demasiadas; en la mayoría de los casos, una encuesta fácil de responder tendría como máximo 4 o 5 opciones.

Una parte interesante de la implementación de esta funcionalidad es cómo aproveché Laravel Livewire como backend. Podría haber creado acciones en el backend para gestionar la adición y eliminación de respuestas, pero esto habría reducido la velocidad de respuesta, ya que cada acción requeriría una llamada al servidor. En su lugar, opté por interactuar directamente con Livewire desde JavaScript usando `$wire`, lo que me permitió utilizar JavaScript puro para mostrar u ocultar opciones de respuesta sin necesidad de hacer viajes al servidor.

De hecho, las 10 opciones posibles se renderizan en la página desde el inicio, pero permanecen ocultas. Cuando quieres agregar una nueva respuesta, simplemente se muestra el campo correspondiente y se habilita para que puedas escribir tu opción.

Todo esto lo hice pensando en que la experiencia que percibas sea lo más rápida y fluida posible.
