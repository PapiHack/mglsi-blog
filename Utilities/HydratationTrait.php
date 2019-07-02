<?php

/**
 * 
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 * 
 */

/**
 * Trait permettant l'hydratation d'un objet.
 */
trait HydratationTrait 
{
    /**
     * Méthode permettant d'hydrater l'objet courant avec les données passées en paramètre sous
     * forme de tableau. 
     *
     * @param Array $data
     * @return void
     */
    private function hydrate(Array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
}