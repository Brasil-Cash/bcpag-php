<?php 

namespace BCpag;

final class Routes{

    public static function transactions()
    {
        $routes = new class{
            
            public static function base () {
                return 'transactions';
            }
    
            public static function capture ($id) {
                return "transactions/$id/capture";
            }
    
            public static function refund ($id) {
                return "transactions/$id/refund";
            }
           
        };

        return $routes;
    }

    public static function links()
    {
        $routes = new class{
            
            public static function base () {
                return 'links';
            }
        
            public static function refund ($id) {
                return "links/$id/refund";
            }
           
        };

        return $routes;
    }
}