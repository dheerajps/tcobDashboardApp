SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		cwm
-- Create date: 10-8-2015
-- Description:	Return all URLs and their respective sections and topics by taking in a group_id as a parameter
-- =============================================
CREATE PROCEDURE dbo.getURLs
	@groupID VARCHAR(50)
AS
BEGIN
	SELECT * FROM dbo.dashboard_urls INNER JOIN dbo.dashboard_linkURLtoGroup
		ON dbo.dashboard_urls.url_id = dbo.dashboard_linkURLtoGroup.url_id JOIN dbo.dashboard_groups
		ON dbo.dashboard_linkURLtoGroup.group_id = dbo.dashboard_groups.group_id
	WHERE dbo.dashboard_groups.group_id = @groupID
	ORDER BY dbo.dashboard_urls.url_name ASC;
END
GO