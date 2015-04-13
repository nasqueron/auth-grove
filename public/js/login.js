/*  -------------------------------------------------------------
    Navigate to Nasqueron
    - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    Author:         Dereckson
    Contributors:   cesiztel
    Tags:           Keyboard navigation login localstorage
    Dependencies:   Mousetrap
    Filename:       cover.js
    Licence:        BSD
    -------------------------------------------------------------    */

/*  -------------------------------------------------------------
    Table of contents
    - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    :: Keyboard events
    :: Pandemonium mode
    
 */
 
/*  -------------------------------------------------------------
    Keyboard events
    - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    */

Mousetrap.bind(
    [
        //Contextual stuff
        '6 6 6',
        'p a n d e m o n i u m',
        'f i r e',
        'm a r t i n',
        
        //More usual stuff
        'up up down down left right left right b a'
    ],
    function() {
        //Set body class to ...
        Pandemonium.enable();
        return false;
    }
);

/*  -------------------------------------------------------------
    Pandemonium mode
    - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    */

var Pandemonium = {
    enable: function () {
        console.log("John Martin - Pandemonium, painting displayed at Le Louvre, Dénon, first floor.");
        document.getElementsByTagName("body")[0].className = "pandemonium";
    }
};
