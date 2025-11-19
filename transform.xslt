<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <!-- Параметры фильтрации -->
    <xsl:param name="examiner" select="''"/>
    <xsl:param name="location" select="''"/>
    <xsl:param name="sort" select="'datetime'"/>

    <xsl:template match="/exams">
        <html>
            <head>
                <meta charset="UTF-8"/>
                <title>Exams</title>
                <style>
                    table { border-collapse: collapse; width: 100%; }
                    th, td { border: 1px solid #666; padding: 6px; }
                </style>
            </head>
            <body>
                <h2>Exams list</h2>

                <table>
                    <tr>
                        <th>ID</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Examiner</th>
                        <th>Duration</th>
                    </tr>

                    <xsl:for-each select="
                        exam[
                            (contains(examiner, $examiner) or $examiner = '') and
                            (contains(location, $location) or $location = '')
                        ]
                    ">
                        <!-- Сортировка -->
                        <xsl:sort select="*[name()=$sort]" data-type="text"/>

                        <tr>
                            <td><xsl:value-of select="@id"/></td>
                            <td><xsl:value-of select="datetime"/></td>
                            <td><xsl:value-of select="location"/></td>
                            <td><xsl:value-of select="examiner"/></td>
                            <td><xsl:value-of select="duration"/></td>
                        </tr>
                    </xsl:for-each>

                </table>

            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
