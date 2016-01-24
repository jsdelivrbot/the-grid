var deltaGibbs=0;
var T=0;
var deltaS=0,
Entropy=0;

var deltaH_enthalpy=0;

function deltaGibbs(temp, s_final, s_initial, deltaH)
{
var Change_in_gibbs=((temp*(s_final-s_initial))+deltaH);
return Change_in_gibbs;
}
