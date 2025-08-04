# Las encuestas ahora usan ULID en las URLs

Hasta ahora, las URLs de las encuestas en Terrific Poll usaban un identificador numérico incremental, lo que hacía que fueran muy fáciles de adivinar. Por ejemplo, si tu encuesta era la número 5, la URL era simplemente `/p/5`. Esto podía comprometer la privacidad de tus encuestas, ya que cualquier persona podía acceder a otras encuestas probando diferentes números en la URL.

A partir de hoy, todas las encuestas utilizan un identificador ULID en la URL, por ejemplo: `/p/01HZYXTESTULID1234567890`. Los ULID son únicos y prácticamente imposibles de adivinar, lo que mejora significativamente la seguridad y privacidad de tus encuestas.
