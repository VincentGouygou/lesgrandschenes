 
 var tabparam=[];
function paramtab() {
    
    tabparam=window.location.search
                            .substr(1)
                            .split('&')
                            .reduce(
        function(accumulator, currentValue) {
            var pair = currentValue
                .split('=')
                .map(function(value) {
                    return decodeURIComponent(value);
                });

            accumulator[pair[0]] = pair[1];

            return accumulator;
        },
        {}
    );
}
 