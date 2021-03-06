<pre>
<?php
/*
Copyright (c) 2013, 2014, Beren Oguz and Alptug Ulugol
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of KAL IEEE nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL BEREN OGUZ BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
/*
 * PART 1- CONFIGURATION
 * Change related variables to create C++ code for Larus Project
 * $name -> Name of the target class
 * $attributes -> An array that includes attributes. Indexes will be named after
 * 					attributes' types.
 */
$name = "AbstractSolidObject";
$brief = "Solid Object class that has physcial traits";
$attributes = array("RealNumber" => array(
	 "force","acceleration","mass","volume","density","weight",
    "angular_momentum","momentum","surface_area","pressure","elascity",
    "electrical_charge","electrical_field","electrical_potential",
    "electrical_resistivity","electrical_impedance","electrical_resistance",
    "electrical_current","fluidity","hardness","temperature","velocity","speed",
	 "tension","plane_angle","melting_point","specific_heat","heat_capacity",
	 "mechanical_energy","kinetic_energy","potential_energy","index_of_refraction",
	 "plasticity","speed_of_sound"));

$formulas = array(

"force = mass * acceleration",
"mass = density * volume",
"mass = force / acceleration",

				);
	 
/*
 * PART 2- IMPLEMENTATION
 * This part will prepare necessary parts of the code that will be created.
 */

$privates="";
$getters="";
$setters="";
$setter_implemens="";
$getter_implemens="";
$copier = ":environment(par.environment),";
$forms = array();

foreach($attributes as $type=>$atts)
{
	foreach($atts as $att)
	{
		$final="";
		foreach($formulas as $formula)
		{
			$forms = explode(" ",$formula);
			if(in_array($att,$forms) && $forms[0] != $att)
			{
				$final .= "\n\t\tif(";
				$neg = "!";
				$bool = "";
				foreach($forms as $form)
				{
					if($form =="=")
					{
						$neg = "";
					}
					elseif(($form != "*")&&($form != "/")&&($form != "+")&&($form != "-")&&($form != "%")&&($form != "^")&&($form != "(")&&($form != ")"))
					{
						$final.= "$bool(".$neg."this->$form.is_defined())";
						$bool = "&&";
					}
				}
				
				$final .= ")\n\t\t{\n\t\t\t";
				
				foreach($forms as $form)
				{
					if($form == "*")
					{
						$final .= " * ";
					}
					elseif($form == "/")
					{
						$final .= " / ";
					}
					elseif($form == "=")
					{
						$final .= " = ";
					}
					elseif($form == "+")
					{
						$final .= " +" ;
					}
					elseif($form == "-")
					{
						$final .= " - ";
					}
					elseif($form == "%")
					{
						$final .= " % ";
					}
					elseif($form == "^")
					{
						$final .= " ^ ";
					}
					elseif($form == "(")
					{
						$final .= " ( ";
					}
					elseif($form == ")")
					{
						$final .= " ) ";
					}
					else
					{
						$final .= "this->$form";
					}
				}
				
				$final.=";\n\t\t}";
			}
		}
		
		$setters .= "\t\t\tvoid set_$att(const $type& par);\n";
		$getters .= "\t\t\tconst $type& get_$att() const;\n";
		//$getters .= "\t\t\t$type& get_$att();\n";
		$privates .= "\t\t\t$type $att;\n";
		$setter_implemens .= "\tvoid $name::set_$att(const $type& par)\n\t{\n\t\tthis->$att = par;\n\t\t$final\n\t\t/*\n\t\t * @TODO\n\t\t * Implement this method!\n\t\t */\n\t}\n\n";
		$getter_implemens .= "\tconst $type& $name::get_$att() const\n\t{\n\t\treturn this->$att;\n\t\t/*\n\t\t * @TODO\n\t\t * Implement this method!\n\t\t */\n\t}\n\n";
		//$getter_implemens .= "\t$type& $name::get_$att() \n\t{\n\t\treturn this->$att;\n\t\t/*\n\t\t * @TODO\n\t\t * Implement this method!\n\t\t */\n\t}\n\n";
		$copier .= "$att(par.$att),";
		
   }
}

$copier = trim($copier,",");

/*
 * PART 3- CODE DUMP
 * This part echoes both declaration and implementation codes of the class in C++
 */

echo <<<EOF
/**
 * @file   $name.hpp
 * @author Beren Oguz, Alptug Ulugol (kadikoyanadoluieee@gmail.com)
 * @date   December, 2013
 * @brief  This file includes the declaration of AbstractSolidObject Class.
 * @copyright
Copyright (c) 2013, 2014 Beren Oguz and Alptug Ulugol
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of KAL IEEE nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL BEREN OGUZ OR ALPTUG ULUGOL BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * @class $name
 * @brief $brief
 */

#include "defines.h"
#include "RealNumber.hpp"
#include "Environment.hpp"

namespace larus
{
	class $name
	{
       	 public:
\t\t\t$name(Environment* env);
\t\t\t$name(const $name&);
\t\t\t~$name();
                
$getters
$setters
        
        	private:
$privates
Environment* environment;
	};
}
/**
 * @file   $name.cpp
 * @author Beren Oguz, Alptug Ulugol (kadikoyanadoluieee@gmail.com)
 * @date   December, 2013
 * @brief  This file includes the implementation of AbstractSolidObject Class.
 * @copyright
Copyright (c) 2013, 2014 Beren Oguz and Alptug Ulugol
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of KAL IEEE nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL BEREN OGUZ OR ALPTUG ULUGOL BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

#include "larus/$name.hpp"

namespace larus
{

\t$name::$name(Environment* env)
:environemt(env)
\t{
	
\t}

\t$name::$name(const $name& par)
\t$copier
\t{

\t}

\t$name::~$name()
\t{

\t}

$setter_implemens
$getter_implemens
}
EOF;
?>
</pre>
