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
DISCLAIMED. IN NO EVENT SHALL BEREN OGUZ OR ALPTUG ULUGOL BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
#ifndef LARUS_NUMBER
#define LARUS_NUMBER

#include "defines.h"
#include "tostring.h"
#include <iostream>
#include "ginac/ginac.h"

namespace larus
{
    class Number
    {
        private:
            PrimitiveNumber value;
            Boolean dfn;

        public:
            Number();
            Number(const int& operand);
        Number(const double& operand);
        Number(const float& operand);
            Number(const Number& operand);
            Number(PrimitiveNumber operand);
            ~Number();

            Boolean is_defined() const;

            const Number& operator = (const Number& operand);
            const Number& operator = (const double operand);
            const Number& operator = (const int& operand);
            const Number& operator = (const char* operand);
            const Number& operator += (const Number& operand);
            const Number& operator -= (const Number& operand);
            const Number& operator *= (const Number& operand);
            const Number& operator /= (const Number& operand);
            const Number& operator %= (const Number& operand);

            Boolean operator == (const Number& operand) const;
            Boolean operator != (const Number& operand) const;
            PrimitiveNumber get_value() const;

            Number& operator ++ ();
            Number operator ++ (int);
            Number& operator -- ();
            Number operator -- (int);

            Number operator + (const Number& operand) const;
            Number operator - (const Number& operand) const;
            Number operator * (const Number& operand) const;
            Number operator / (const Number& operand) const;
            Number operator % (const Number& operand) const;
            Number operator ^ (const Number& operand) const;

            Number sin () const;
            Number cos () const;
            Number tan () const;
            Number cot () const;
            Number sec () const;
            Number csc () const;
            Number arcsin () const;
            Number arccos () const;
            Number arctan () const;
            Number arccot () const;
            Number arcsec () const;
            Number arccsc () const;

            Number to_degree() const;
            Number to_radian() const;
            
            Number log () const;
            Number log (const Number& base) const;
            Number ln () const;
        
            Number inverse() const;
        
            Number abs () const;
            Number sqrt () const;
            Number cbrt () const;
            Number root(const Number& rt) const;
    };
}

std::ostream& operator << (std::ostream& stream,const larus::Number& number);

#endif //LARUS_REAL_NUMBER