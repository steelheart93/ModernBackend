
CREATE OR REPLACE FUNCTION CONSULTAR_RANKING
(RANKING TOP_EDITORS.TOP_ID%TYPE)
RETURN VARCHAR2 
AS
  CURSOR CONSULTA IS
    SELECT TOP_ID, EDITOR_NAME
    FROM TOP_EDITORS
    WHERE TOP_ID = RANKING;
    
  CADENA_JSON VARCHAR(3000);
BEGIN
  FOR FILA IN CONSULTA LOOP
    CADENA_JSON := '{ "ID":"' || FILA.TOP_ID || '", '
      || '"NAME": "' || FILA.EDITOR_NAME ||'" }';
  END LOOP;
  
  RETURN CADENA_JSON;
END CONSULTAR_RANKING;
