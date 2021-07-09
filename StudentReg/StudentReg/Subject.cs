using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace StudentReg
{
    class Subject
    {
        public string id { get; set; }
        public string name { get; set; }
        public string desciption { get; set; }

        public Subject(string id, string name, string description)
        {
            this.id = id;
            this.name = name;
            this.desciption = description;
            
        }

        public string Details()
        {
            return
                $"   \n   Subject details: \n   " +
                $"----------------------------------- \n   " +
                $"Subject id: {id} \n   " +
                $"Name: {this.name} \n   " +
                $"Description: {this.desciption} \n   " +
                $"-----------------------------------";
        }

    }
}
