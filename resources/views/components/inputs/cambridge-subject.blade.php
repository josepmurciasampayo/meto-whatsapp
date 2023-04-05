
            
     @props(['name', 'label', 'saved' => ''])

     <x-inputs.select-other :name="$name" :label="$label" :saved="$saved">
         <x-slot name="options">
        
            <option value="Accounting">Accounting</option>
    <option value="Accounting (9-1)">Accounting (9-1)</option>
    <option value="Afrikaans - Second Language">Afrikaans - Second Language</option>
    <option value="Agriculture">Agriculture</option>
    <option value="Arabic - First Language">Arabic - First Language</option>
    <option value="Arabic - First Language (9-1)">Arabic - First Language (9-1)</option>
    <option value="Arabic - Foreign Language">Arabic - Foreign Language</option>
    <option value="Art & Design">Art & Design</option>
    <option value="Art & Design (9-1)">Art & Design (9-1)</option>
    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
    <option value="Biology">Biology</option>
    <option value="Biology (9-1)">Biology (9-1)</option>
    <option value="Business Studies">Business Studies</option>
    <option value="Business Studies (9-1)">Business Studies (9-1)</option>
    <option value="Chemistry">Chemistry</option>
    <option value="Chemistry (9-1)">Chemistry (9-1)</option>
    <option value="Chinese - First Language">Chinese - First Language</option>
    <option value="Chinese - Second Language">Chinese - Second Language</option>
    <option value="Chinese (Mandarin) - Foreign Language">Chinese (Mandarin) - Foreign Language</option>
    <option value="Computer Science">Computer Science</option>
    <option value="Computer Science (9-1)">Computer Science (9-1)</option>
    <option value="Design & Technology">Design & Technology</option>
    <option value="Design & Technology (9-1)">Design & Technology (9-1)</option>
    <option value="Development Studies">Development Studies</option>
    <option value="Drama">Drama</option>
    <option value="Drama (9-1)">Drama (9-1)</option>
    <option value="Dutch - Foreign Language">Dutch - Foreign Language</option>
    <option value="Economics">Economics</option>
    <option value="Economics (9-1)">Economics (9-1)</option>
    <option value="English - First Language">English - First Language</option>
    <option value="English - First Language (9-1)">English - First Language (9-1)</option>
    <option value="English - First Language (US)">English - First Language (US)</option>
    <option value="English Literature (US)">English Literature (US)</option>
    <option value="English - Literature in English">English - Literature in English</option>
    <option value="English - Literature in English (9-1)">English - Literature in English (9-1)</option>
    <option value="English as a Second Language (Count-in speaking)">English as a Second Language (Count-in speaking)</option>
    <option value="English as a Second Language (Count-in Speaking) (9-1)">English as a Second Language (Count-in Speaking) (9-1)</option>
    <option value="English as a Second Language (Speaking Endorsement)">English as a Second Language (Speaking Endorsement)</option>
    <option value="English as a Second Language (Speaking Endorsement) (9-1)">English as a Second Language (Speaking Endorsement) (9-1)</option>
    <option value="Enterprise">Enterprise</option>
    <option value="Environmental Management">Environmental Management</option>
    <option value="Food & Nutrition">Food & Nutrition</option>
    <option value="French - First Language">French - First Language</option>
    <option value="French - Foreign Language">French - Foreign Language</option>
    <option value="French (9-1)">French (9-1)</option>
    <option value="Geography">Geography</option>
    <option value="Geography (9-1)">Geography (9-1)</option>
    <option value="German - First Language">German - First Language</option>
    <option value="German - Foreign Language">German - Foreign Language</option>
    <option value="German (9-1)">German (9-1)</option>
    <option value="Global Perspectives">Global Perspectives</option>
    <option value="Greek - Foreign Language">Greek - Foreign Language</option>
    <option value="Hindi as a Second Language">Hindi as a Second Language</option>
    <option value="History">History</option>
    <option value="History - American (US)">History - American (US)</option>
    <option value="History (9-1)">History (9-1)</option>
    <option value="Indonesian - Foreign Language">Indonesian - Foreign Language</option>
    <option value="Information & Communication Technology">Information & Communication Technology</option>
    <option value="Information & Communication Technology (9-1)">Information & Communication Technology (9-1)</option>
    <option value="IsiZulu as a Second Language">IsiZulu as a Second Language</option>
    <option value="Islamiyat">Islamiyat</option>
    <option value="Italian - Foreign Language">Italian - Foreign Language</option>
    <option value="Italian (9-1)">Italian (9-1)</option>
    <option value="Japanese - Foreign Language">Japanese - Foreign Language</option>
    <option value="Korean (First Language)">Korean (First Language)</option>
    <option value="Latin">Latin</option>
    <option value="Malay - First Language">Malay - First Language</option>
    <option value="Malay - Foreign Language">Malay - Foreign Language</option>
    <option value="Marine Science (Maldives only)">Marine Science (Maldives only)</option>
    <option value="Mathematics">Mathematics</option>
    <option value="Mathematics - Additional">Mathematics - Additional</option>
    <option value="Mathematics - Additional (US)">Mathematics - Additional (US)</option>
    <option value="Mathematics - International">Mathematics - International</option>
    <option value="Mathematics (9-1)">Mathematics (9-1)</option>
    <option value="Mathematics (US)">Mathematics (US)</option>
    <option value="Music">Music</option>
    <option value="Music (9-1)">Music (9-1)</option>
    <option value="Pakistan Studies">Pakistan Studies</option>
    <option value="Physical Education">Physical Education</option>
    <option value="Physical Education (9-1)">Physical Education (9-1)</option>
    <option value="Physical Science">Physical Science</option>
    <option value="Physics">Physics</option>
    <option value="Physics (9-1)">Physics (9-1)</option>
    <option value="Portuguese - First Language">Portuguese - First Language</option>
    <option value="Portuguese - Foreign Language">Portuguese - Foreign Language</option>
    <option value="Religious Studies">Religious Studies</option>
    <option value="Russian - First Language">Russian - First Language</option>
    <option value="Sanskrit">Sanskrit</option>
    <option value="Science - Combined">Science - Combined</option>
    <option value="Sciences - Co-ordinated (9-1)">Sciences - Co-ordinated (9-1)</option>
    <option value="Sciences - Co-ordinated (Double)">Sciences - Co-ordinated (Double)</option>
    <option value="Sociology">Sociology</option>
    <option value="Spanish - First Language">Spanish - First Language</option>
    <option value="Spanish - Foreign Language">Spanish - Foreign Language</option>
    <option value="Spanish - Literature">Spanish - Literature</option>
    <option value="Spanish (9-1)">Spanish (9-1)</option>
    <option value="Swahili">Swahili</option>
    <option value="Thai - First Language">Thai - First Language</option>
    <option value="Travel & Tourism">Travel & Tourism</option>
    <option value="Turkish - First Language">Turkish - First Language</option>
    <option value="Urdu as a Second Language">Urdu as a Second Language</option>
    <option value="World Literature">World Literature</option>
    <option value="AP Spanish Language and Culture">AP Spanish Language and Culture</option>
               
            
         </x-slot>
     </x-inputs.select-other>  


                
        